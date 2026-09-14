<?php
require_once __DIR__ . '/../includes/functions.php';

$itemId = isset($_POST['item_id']) ? (int) $_POST['item_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

if ($itemId <= 0) {
    setFlash('error', 'Cart item not found.');
    header('Location: ../cart.php');
    exit;
}

if (updateCartQuantity($itemId, $quantity)) {
    setFlash('success', 'Cart updated successfully.');
} else {
    setFlash('error', 'Unable to update the cart.');
}

header('Location: ../cart.php');
exit;
