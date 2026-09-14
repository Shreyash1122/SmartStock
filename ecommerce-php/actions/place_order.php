<?php
require_once __DIR__ . '/../includes/functions.php';

$customerName = trim($_POST['customer_name'] ?? '');
$customerEmail = trim($_POST['customer_email'] ?? '');
$customerPhone = trim($_POST['customer_phone'] ?? '');
$address = trim($_POST['address'] ?? '');

if ($customerName === '' || $customerEmail === '' || $customerPhone === '' || $address === '') {
    setFlash('error', 'Please complete every checkout field.');
    header('Location: ../checkout.php');
    exit;
}

$orderId = createOrder($customerName, $customerEmail, $customerPhone, $address);

if ($orderId) {
    setFlash('success', 'Order placed successfully. Your order number is #' . $orderId . '.');
    header('Location: ../index.php');
    exit;
}

setFlash('error', 'Unable to place the order right now.');
header('Location: ../checkout.php');
exit;
