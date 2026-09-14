<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Cart';
$cartData = cartTotals();
require_once __DIR__ . '/includes/header.php';
?>
<section class="section-heading stacked">
    <div>
        <p class="eyebrow">Shopping Cart</p>
        <h1>Your Cart</h1>
        <p>Review your selected items before checkout.</p>
    </div>
</section>
<?php if (empty($cartData['items'])): ?>
    <div class="empty-state">
        <h2>Your cart is empty</h2>
        <p>Add products from the catalog to begin an order.</p>
        <a class="button primary" href="products.php">Browse Products</a>
    </div>
<?php else: ?>
    <div class="cart-layout">
        <div class="cart-table-wrap">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartData['items'] as $item): ?>
                        <tr>
                            <td>
                                <div class="cart-product">
                                    <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>">
                                    <span><?php echo e($item['name']); ?></span>
                                </div>
                            </td>
                            <td><?php echo money($item['price']); ?></td>
                            <td>
                                <form action="actions/update_cart.php" method="post" class="quantity-update-form">
                                    <input type="hidden" name="item_id" value="<?php echo (int) $item['id']; ?>">
                                    <input type="number" name="quantity" min="0" value="<?php echo (int) $item['quantity']; ?>">
                                    <button type="submit" class="button small secondary">Update</button>
                                </form>
                            </td>
                            <td><?php echo money($item['price'] * $item['quantity']); ?></td>
                            <td>
                                <form action="actions/remove_from_cart.php" method="post">
                                    <input type="hidden" name="item_id" value="<?php echo (int) $item['id']; ?>">
                                    <button type="submit" class="text-button" data-confirm="Remove this item from the cart?">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <aside class="summary-card">
            <h2>Order Summary</h2>
            <div class="summary-row">
                <span>Items</span>
                <strong><?php echo $cartData['count']; ?></strong>
            </div>
            <div class="summary-row">
                <span>Subtotal</span>
                <strong><?php echo money($cartData['subtotal']); ?></strong>
            </div>
            <a class="button primary full" href="checkout.php">Proceed to Checkout</a>
        </aside>
    </div>
<?php endif; ?>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
