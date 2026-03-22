<?php
// Safe image responder — outputs only raw image bytes with correct headers.
// Save this file as UTF-8 without BOM and overwrite the existing showImage.php.

error_reporting(0);
ini_set('display_errors', '0');

$connector = __DIR__ . '/db_connection.php';
if (!is_file($connector)) {
    http_response_code(500);
    exit;
}
require $connector;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    http_response_code(400);
    exit;
}

$stmt = $conn->prepare('SELECT product_img FROM ecommerce_table WHERE product_id = ? LIMIT 1');
if (!$stmt) {
    http_response_code(500);
    exit;
}
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $stmt->close();
    http_response_code(404);
    exit;
}
$stmt->bind_result($img);
$stmt->fetch();
$stmt->close();

// Otherwise treat as binary blob stored in DB
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_buffer($finfo, $img) ?: $defaultMime;
finfo_close($finfo);

header('Content-Type: ' . $mime);
header('Content-Length: ' . strlen($img));
header('Content-Disposition: inline; filename="image-' . $id . '"');
echo $img;
exit;
?>
