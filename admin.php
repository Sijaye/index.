<?php
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ensure product_id uses AUTO_INCREMENT safely (do not blindly add PRIMARY KEY)
    $check = $conn->prepare("SELECT COLUMN_KEY, EXTRA FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecommerce_table' AND COLUMN_NAME = 'product_id'");
    if ($check) {
        $check->execute();
        $res = $check->get_result();
        if ($res && $row = $res->fetch_assoc()) {
            $hasAuto = stripos($row['EXTRA'], 'auto_increment') !== false;
            $isPrimary = strtoupper($row['COLUMN_KEY']) === 'PRI';
            if (!$hasAuto) {
                // Modify to add AUTO_INCREMENT only
                if ($conn->query("ALTER TABLE `ecommerce_table` MODIFY COLUMN `product_id` INT NOT NULL AUTO_INCREMENT") === FALSE) {
                    error_log('admin.php: Failed to set product_id AUTO_INCREMENT: ' . $conn->error);
                }
            }
            if (!$isPrimary) {
                // Check whether any primary key exists on the table
                $pkCheck = $conn->prepare("SELECT COUNT(*) AS cnt FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecommerce_table' AND CONSTRAINT_TYPE = 'PRIMARY KEY'");
                if ($pkCheck) {
                    $pkCheck->execute();
                    $rpk = $pkCheck->get_result()->fetch_assoc();
                    if (intval($rpk['cnt']) === 0) {
                        // safe to add primary key on product_id
                        if ($conn->query("ALTER TABLE `ecommerce_table` ADD PRIMARY KEY (`product_id`)") === FALSE) {
                            error_log('admin.php: Failed to add PRIMARY KEY on product_id: ' . $conn->error);
                        }
                    }
                    $pkCheck->close();
                }
            }
        }
        $check->close();
    }

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    if (!isset($_FILES['product_img']) || $_FILES['product_img']['error'] !== 0) {
        die("image upload failed.");
    }

    $imagedata = file_get_contents($_FILES['product_img']['tmp_name']);

    // Re-check whether product_id is AUTO_INCREMENT; if not, compute a safe next id and insert explicitly
    $needsManualId = false;
    $check2 = $conn->prepare("SELECT EXTRA FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ecommerce_table' AND COLUMN_NAME = 'product_id'");
    if ($check2) {
        $check2->execute();
        $res2 = $check2->get_result();
        if ($res2 && $r2 = $res2->fetch_assoc()) {
            if (stripos($r2['EXTRA'], 'auto_increment') === false) $needsManualId = true;
        }
        $check2->close();
    }

    if ($needsManualId) {
        // compute next id to avoid duplicate primary key error
        $resMax = $conn->query("SELECT COALESCE(MAX(product_id), 0) AS maxid FROM ecommerce_table");
        $max = $resMax ? intval($resMax->fetch_assoc()['maxid']) : 0;
        $nextId = $max + 1;
        $sql = "INSERT INTO ecommerce_table (product_id, product_name, price, stocks, product_img) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) { echo "Prepare failed: " . $conn->error; exit; }
        $stmt->bind_param("isdis", $nextId, $product_name, $price, $stock, $imagedata);
    } else {
        $sql = "INSERT INTO ecommerce_table (product_name, price, stocks, product_img) VALUES  (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) { echo "Prepare failed: " . $conn->error; exit; }
        $stmt->bind_param("sdis", $product_name, $price, $stock, $imagedata);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Successful'); window.location.href='admin.php'</script>";
    } else{
       echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
<link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="carousel/carousel.css">

<style>

:root {
    --blue: #2980b9;
    --red: tomato;
    --orange: orange;
    --black: #333 ;
    --white:#fff;
    --bg-color:#eee;
    --dark-bg:#eee;
    --box-shadow:0.5rem 1rem rgba(0,0,0,.1);
    --border:.1rem solid #999;
}

body {
    background-color:black;
}

.container {
    max-width: 1200px;
    margin:0 auto;

}

section {
    padding: 2rem;
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 3rem;
    background-color: black;
    min-height: 100vh;
}

.form-wrapper {
    display: flex;
    flex-direction: column;
}

.table-wrapper {
    display: flex;
    flex-direction: column;
}

input[type="submit"]{
display: block;
width: 100%;
text-align: center;
background-color: white;
border: 1px solid black;
color: black;
font-size: 1.7rem;
padding: 10px;
border-radius: .5rem;
margin-top: 1rem;
}


input[type="submit"]:hover{ 
 background-color: black;
 cursor: pointer;
}


#menu-btn {
    margin-left: 2rem;
    font-size: 3rem;
    cursor: pointer;
    color:var(--white);
    display: none;
}



.add-product-form {
    background-color: var(--white);
    padding: 2rem;
    border-radius: .5rem;
    box-shadow: var(--box-shadow);
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.add-product-form h3 {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: var(--black);
    text-transform: uppercase;
    text-align: center;
    font-weight: 600;
    border-bottom: .2rem solid var(--blue);
    padding-bottom: 1rem;
}

.add-product-form .box {
    padding: 0.9rem 1rem;
    font-size: 1.3rem;
    color: var(--black);
    border-radius: .4rem;
    background-color: #f9f9f9;
    margin: 0.8rem 0;
    width: 100%;
    border: .1rem solid #ddd;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

.add-product-form .box:focus {
    outline: none;
    border-color: var(--blue);
    background-color: var(--white);
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    border-radius: .5rem;
    overflow: hidden;
}

table thead {
    background-color: var(--blue);
    color: var(--white);
}

table th {
    padding: 1.5rem;
    text-align: left;
    font-size: 1.2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .1rem;
}

table td {
    padding: 1.5rem;
    border-bottom: .1rem solid #ddd;
    font-size: 1.4rem;
    color: var(--black);
}

table tbody tr {
    transition: background-color 0.3s ease;
}

table tbody tr:hover {
    background-color: #f5f5f5;
}

table img {
    border-radius: .5rem;
    object-fit: cover;
}

.table-actions {
    display: flex;
    gap: 0.5rem;
}

.table-actions button {
    padding: 0.7rem 1.2rem;
    font-size: 1.2rem;
    border: none;
    border-radius: .3rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.edit-btn {
    background-color: var(--orange);
    color: var(--white);
}

.edit-btn:hover {
    background-color: #cc8800;
}

.delete-btn-table {
    background-color: var(--red);
    color: var(--white);
}

.delete-btn-table:hover {
    background-color: #d32f2f;
}

@media(max-width:1200px){
    section {
        grid-template-columns: 1fr;
    }
    
    .add-product-form {
        position: static;
    }
}


@media (max-width:991px){
    html {
        font-size: 55%;
    }
    
    table {
        font-size: 1.2rem;
    }
    
    table th, table td {
        padding: 1rem;
    }
}


</style>
</head>

<body>

<?php include 'header.php'; 

?>

<section>
<div class="form-wrapper">
<form method="POST" class="add-product-form" enctype="multipart/form-data">
    <h3>Add Product</h3>    
    <input type="text" class="box" placeholder="Product ID" readonly>
    <input type="text" name="product_name" class="box" placeholder="Product Name" required>
    <input type="number" name="price" class="box" placeholder="Price" step="0.01" required>
    <input type="number" name="stock" class="box" placeholder="Stock Quantity" required>
    <input type="file" name="product_img" class="box" accept="image/png, image/jpg, image/jpeg, image/webp, image/jfif" required>
    <input type="submit" name="submit" value="Add Product" class="btn">
</form>
</div>

<div class="table-wrapper">
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Product Image</th>
        <th>Price</th>
        <th>Stocks</th>
    </tr>
    </thead>

    <tbody>
        <?php
        $sql = "SELECT * FROM ecommerce_table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>{$row['product_id']}</td>";
                echo "<td>{$row['product_name']}</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['product_img']) . "' alt='Product' style='width: 60px; height: 60px;'></td>";
                echo "<td>\$" . number_format($row['price'], 2) . "</td>";
                echo "<td><strong>{$row['stocks']}</strong></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center; padding: 2rem;'>No products found</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>




</section>
</body>
</html>
