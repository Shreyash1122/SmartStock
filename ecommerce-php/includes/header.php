<?php
require_once __DIR__ . '/functions.php';
$cart = cartTotals();
$flash = getFlash();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? e($pageTitle) . ' | ' : ''; ?><?php echo e(SITE_NAME); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="site-header">
        <div class="container topbar">
            <a class="brand" href="index.php"><?php echo e(SITE_NAME); ?></a>
            <nav class="main-nav">
                <a href="index.php" class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">Home</a>
                <a href="products.php" class="<?php echo $currentPage === 'products.php' || $currentPage === 'product.php' ? 'active' : ''; ?>">Products</a>
                <a href="about.php" class="<?php echo $currentPage === 'about.php' ? 'active' : ''; ?>">About Us</a>
                <a href="contact.php" class="<?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>">Contact Us</a>
                <a href="cart.php" class="<?php echo $currentPage === 'cart.php' || $currentPage === 'checkout.php' ? 'active' : ''; ?>">Cart (<?php echo $cart['count']; ?>)</a>
            </nav>
        </div>
    </header>
    <main class="page-content">
        <div class="container">
            <?php if ($flash): ?>
                <div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div>
            <?php endif; ?>
