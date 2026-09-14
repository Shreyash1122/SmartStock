<?php
require_once __DIR__ . '/includes/functions.php';
$cartData = cartTotals();
if (empty($cartData['items'])) {
    setFlash('error', 'Add items to your cart before checkout.');
    header('Location: cart.php');
    exit;
}
$pageTitle = 'Checkout';
require_once __DIR__ . '/includes/header.php';
?>
<section class="section-heading stacked">
    <div>
        <p class="eyebrow">Checkout</p>
        <h1>Complete Your Order</h1>
        <p>Your order will be saved in the SQL database.</p>
    </div>
</section>
<div class="checkout-layout">
    <form class="form-card" action="actions/place_order.php" method="post">
        <label for="customer_name">Full Name</label>
        <input id="customer_name" name="customer_name" type="text" required>
        <label for="customer_email">Email Address</label>
        <input id="customer_email" name="customer_email" type="email" required>
        <label for="customer_phone">Phone Number</label>
        <input id="customer_phone" name="customer_phone" type="text" required>
        <label for="address">Shipping Address</label>
        <textarea id="address" name="address" rows="5" required></textarea>
        <button type="submit" class="button primary">Place Order</button>
    </form>
    <aside class="summary-card">
        <h2>Order Items</h2>
        <?php foreach ($cartData['items'] as $item): ?>
            <div class="summary-row compact">
                <span><?php echo e($item['name']); ?> x <?php echo (int) $item['quantity']; ?></span>
                <strong><?php echo money($item['price'] * $item['quantity']); ?></strong>
            </div>
        <?php endforeach; ?>
        <div class="summary-row total">
            <span>Total</span>
            <strong><?php echo money($cartData['subtotal']); ?></strong>
        </div>
    </aside>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
