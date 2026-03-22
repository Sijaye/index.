<?php
include __DIR__ . 'db_connection.php';
$res = $conn->query('SELECT product_id, product_name FROM ecommerce_table');
if (!$res) {
    echo "Query error: " . $conn->error . "\n";
    exit(1);
}
$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = $r;
}
echo "Found: " . count($rows) . " rows\n";
foreach ($rows as $r) {
    echo $r['product_id'] . "\t" . $r['product_name'] . "\n";
}
?>