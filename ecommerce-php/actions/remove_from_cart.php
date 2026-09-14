<?php
require_once __DIR__ . '/../includes/functions.php';

$itemId = isset($_POST['item_id']) ? (int) $_POST['item_id'] : 0;

if ($itemId <= 0) {
    setFlash('error', 'Cart item not found.');
    header('Location: ../cart.php');
    exit;
}

if (removeCartItem($itemId)) {
    setFlash('success', 'Item removed from cart.');
} else {
    setFlash('error', 'Unable to remove the item.');
}

header('Location: ../cart.php');
exit;
