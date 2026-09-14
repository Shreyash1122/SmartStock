<?php
require_once __DIR__ . '/../includes/functions.php';

$productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? max(1, (int) $_POST['quantity']) : 1;
$product = fetchProduct($productId);

if (!$product) {
    setFlash('error', 'Unable to add that product.');
    header('Location: ../products.php');
    exit;
}

if (addItemToCart($productId, $quantity)) {
    setFlash('success', 'Product added to cart.');
} else {
    setFlash('error', 'Database connection failed while adding the product.');
}

header('Location: ../cart.php');
exit;
