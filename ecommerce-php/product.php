<?php
require_once __DIR__ . '/includes/functions.php';
$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = fetchProduct($productId);
if (!$product) {
    setFlash('error', 'Product not found.');
    header('Location: products.php');
    exit;
}
$pageTitle = $product['name'];
require_once __DIR__ . '/includes/header.php';
?>
<section class="product-detail">
    <div class="product-detail-image">
        <img src="<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>">
    </div>
    <div class="product-detail-copy">
        <p class="eyebrow"><?php echo e($product['category']); ?></p>
        <h1><?php echo e($product['name']); ?></h1>
        <p class="price-large"><?php echo money($product['price']); ?></p>
        <p><?php echo e($product['description']); ?></p>
        <form action="actions/add_to_cart.php" method="post" class="purchase-form">
            <input type="hidden" name="product_id" value="<?php echo (int) $product['id']; ?>">
            <label for="quantity">Quantity</label>
            <div class="quantity-row">
                <button type="button" class="quantity-button" data-action="decrease">-</button>
                <input id="quantity" name="quantity" type="number" min="1" value="1">
                <button type="button" class="quantity-button" data-action="increase">+</button>
            </div>
            <button type="submit" class="button primary full">Add to Cart</button>
        </form>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
