<?php
include 'db_connection.php';

// Handle order submission directly in this page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_name = isset($_POST['product_name']) ? trim($_POST['product_name']) : '';
    $quantity = isset($_POST['total_order']) ? intval($_POST['total_order']) : 0;
    $total_price = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0.00;

    if ($product_id <= 0 || $quantity <= 0) {
        header('Location: shop.php?error=' . urlencode('Invalid product or quantity.'));
        exit;
    }

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare('SELECT stocks FROM ecommerce_table WHERE product_id = ? FOR UPDATE');
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $stmt->bind_result($stocks);
        if (!$stmt->fetch()) {
            throw new Exception('Product not found.');
        }
        $stmt->close();

        if ($stocks < $quantity) {
            $conn->rollback();
            header('Location: shop.php?error=' . urlencode('Not enough stock available.'));
            exit;
        }

        $create = "CREATE TABLE IF NOT EXISTS `orders` (
            `order_id` INT AUTO_INCREMENT PRIMARY KEY,
            `product_id` INT NOT NULL,
            `product_name` VARCHAR(255) NOT NULL,
            `quantity` INT NOT NULL,
            `total_price` DECIMAL(10,2) NOT NULL,
            `order_date` DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $conn->query($create);

        $ins = $conn->prepare('INSERT INTO `orders` (product_id, product_name, quantity, total_price) VALUES (?, ?, ?, ?)');
        $ins->bind_param('isid', $product_id, $product_name, $quantity, $total_price);
        $ins->execute();
        $ins->close();

        $upd = $conn->prepare('UPDATE ecommerce_table SET stocks = stocks - ? WHERE product_id = ?');
        $upd->bind_param('ii', $quantity, $product_id);
        $upd->execute();
        $upd->close();

        $conn->commit();

        // Redirect back without showing the success popup
        header('Location: shop.php');
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        header('Location: shop.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <script src="assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="carousel/carousel.css?v=5.0">
</head>
<body>
<?php include 'header.php';?>
<?php
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger" role="alert" style="margin:20px;">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>

<section>

        <?php 
        include 'db_connection.php';
        $sql = "SELECT * FROM ecommerce_table";
        $result = $conn->query($sql);
        ?>

        <div class="product-grid">
        <?php 
            if ($result->num_rows > 0) {
                while($product = $result->fetch_assoc()) {
        ?>
            <div class="product-card">

                <!-- IMAGE HOLDER -->

                    <div class="prodImageHolder">
                        <img src="show_image.php?id=<?php echo $product['product_id']; ?>" alt="<?php echo $product['product_name']; ?>">
                    </div>

                <!-- NAME LABEL -->

                    <div class="label-box">
                        <strong>Product Name: </strong> <?php echo $product['product_name']; ?>
                    </div>

                <!-- PRICE LABEL -->

                    <div class="label-box">
                        <strong>Price: </strong> $<?php echo number_format((float)$product['price'], 2); ?>
                    </div>

                <!-- STOCK LABEL -->
                    <div class="label-box">
                        <strong>Stocks Available: </strong> <?php echo $product['stocks']; ?>
                    </div>
                
                <!-- BUTTONS -->
                    <div class="button-groups">
                        <button class="addCart" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo $product['product_name']; ?>', <?php echo $product['price']; ?>, 'show_image.php?id=<?php echo $product['product_id']; ?>', <?php echo $product['stocks']; ?>)">Buy Now</button>
                        <button class="buyNow" onclick="buyNow(<?php echo $product['product_id']; ?>)">Add to Cart</button>

            </div>
        </div>
        <?php 
            }
        } else {
            echo "No products found.";
        }
        $conn->close();
        ?>
        </section>

<div class="modal-overlay" id="modal">
  <div class="modal-container">
    <div class="modal-header">
      <h2 class="modal-title">Add to Cart</h2>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form action="shop.php" method="POST" onsubmit="return confirmOrder(event)">
      <div class="modal-body">
        <div style="text-align: center; margin-bottom: 20px;">
          <img src="" id="img_id" alt="" style="max-width: 200px; border-radius: 12px;">
        </div>
        
        <div class="modal-form-group">
          <label>Product</label>
          <input type="text" name="product_name" id="product_name" readonly>
          <input type="hidden" name="product_id" id="product_id">
        </div>

        <div class="modal-form-group">
          <label>Unit Price</label>
          <input type="text" id="unit_price" readonly>
        </div>

        <div class="modal-form-group">
          <label>Quantity</label>
          <input type="number" name="total_order" id="total_order" value="1" min="1" onchange="calculateTotal()" oninput="calculateTotal()" required>
        </div>

        <div class="modal-info">
          <div class="modal-info-item">
            <span>Total Price</span>
            <span id="total_price_display">$0.00</span>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="modal-btn modal-btn-secondary" onclick="closeModal()">Cancel</button>
        <button type="submit" class="modal-btn modal-btn-primary">Confirm Order</button>
      </div>
      <input type="hidden" name="total_price" id="total_price">
    </form>
  </div>
</div>

<script>
function addToCart(productId, productName, price, imgSrc, stocks) {
  if (stocks <= 0) {
    alert('This product is out of stock.');
    return;
  }
  document.getElementById('product_id').value = productId;
  document.getElementById('product_name').value = productName;
  document.getElementById('unit_price').value = '$' + parseFloat(price).toFixed(2);
  document.getElementById('img_id').src = imgSrc;
  const qtyInput = document.getElementById('total_order');
  qtyInput.value = 1;
  qtyInput.max = stocks;
  document.getElementById('total_price').value = price;
  calculateTotal();
  document.getElementById('modal').classList.add('active');
}

function calculateTotal() {
  const quantity = parseFloat(document.getElementById('total_order').value) || 0;
  const unitPriceText = document.getElementById('unit_price').value;
  const unitPrice = parseFloat(unitPriceText.replace('$', '')) || 0;
  const total = quantity * unitPrice;
  
  document.getElementById('total_price').value = total.toFixed(2);
  document.getElementById('total_price_display').textContent = '$' + total.toFixed(2);
}

function closeModal() {
  document.getElementById('modal').classList.remove('active');
}

function confirmOrder(event) {
  // Ask for confirmation and allow the form to submit if confirmed
  const confirmed = confirm('Are you sure you want to place this order?');
  if (!confirmed) {
    // prevent submission if user cancels
    return false;
  }
  // allow the form to submit to server
  return true;
}

function buyNow(productId) {
  // Add buy now functionality here
  console.log('Buy now for product:', productId);
}

// Close modal when clicking outside of it
window.onclick = function(event) {
  const modal = document.getElementById('modal');
  if (event.target === modal) {
    modal.classList.remove('active');
  }
}
</script>

<footer class="footer-container">
  <div class="footer-section footer-brand">
    <div class="footer-logo-wrapper">
      <img src="img/Logo2-removebg.png" alt="Logo" class="footer-logo">
    </div>
    <h3 class="footer-brand-name">PIE•CE</h3>
    <p class="footer-brand-tagline">Premium quality products delivered to your door</p>
  </div>

  <div class="footer-section">
    <h4 class="footer-section-title">Quick Links</h4>
    <ul class="footer-links">
      <li><a href="Home.php">Home</a></li>
      <li><a href="shop.php">Shop</a></li>
      <li><a href="About.php">About</a></li>
      <li><a href="Contact.php">Contact</a></li>
    </ul>
  </div>

  <div class="footer-section">
    <h4 class="footer-section-title">Customer Support</h4>
    <ul class="footer-links">
      <li><a href="#">FAQ</a></li>
      <li><a href="#">Shipping Info</a></li>
      <li><a href="#">Returns & Exchanges</a></li>
      <li><a href="#">Track Order</a></li>
    </ul>
  </div>

  <div class="footer-section">
    <h4 class="footer-section-title">Contact Info</h4>
    <p class="footer-contact">
      <strong>Email:</strong> <a href="mailto:info@store.com">piece@store.com</a>
    </p>
    <p class="footer-contact">
      <strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a>
    </p>
    <p class="footer-contact">
      <strong>Address:</strong> 144 San Miguel Street
    </p>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2024 PIE•CE. All rights reserved.</p>
    <div class="footer-legal">
      <a href="#">Privacy Policy</a>
      <span class="divider">|</span>
      <a href="#">Terms of Service</a>
      <span class="divider">|</span>
      <a href="#">Cookie Policy</a>
    </div>
  </div>
</footer>

</body>
</html>
