<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Products';
$products = fetchProducts();
require_once __DIR__ . '/includes/header.php';
?>
<section class="section-heading stacked">
    <div>
        <p class="eyebrow">Catalog</p>
        <h1>Products</h1>
        <p>All products are loaded from the SQL database.</p>
    </div>
</section>
<section class="product-grid">
    <?php foreach ($products as $product): ?>
        <article class="product-card">
            <img src="<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>">
            <div class="product-card-content">
                <p class="category"><?php echo e($product['category']); ?></p>
                <h3><?php echo e($product['name']); ?></h3>
                <p><?php echo e($product['description']); ?></p>
                <div class="product-card-footer align-start">
                    <strong><?php echo money($product['price']); ?></strong>
                    <div class="inline-actions">
                        <a class="button small secondary" href="product.php?id=<?php echo (int) $product['id']; ?>">Details</a>
                        <form action="actions/add_to_cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo (int) $product['id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="button small primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
