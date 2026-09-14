<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Home';
$featuredProducts = fetchProducts(4);
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Everyday ecommerce demo</p>
        <h1>Clean shopping pages backed by PHP and SQL.</h1>
        <p>Browse a focused product catalog, save items to your cart, and place orders through a simple MySQL-powered flow.</p>
        <div class="hero-actions">
            <a class="button primary" href="products.php">Shop Products</a>
            <a class="button secondary" href="about.php">Learn More</a>
        </div>
    </div>
    <div class="hero-panel">
        <h2>Why this build works</h2>
        <ul>
            <li>Multi-page PHP storefront</li>
            <li>Products loaded from SQL</li>
            <li>Cart stored in the database</li>
            <li>Contact messages saved with PHP</li>
        </ul>
    </div>
</section>
<section class="section-heading">
    <div>
        <p class="eyebrow">Featured</p>
        <h2>Top picks for your store</h2>
    </div>
    <a class="text-link" href="products.php">View all products</a>
</section>
<section class="product-grid">
    <?php foreach ($featuredProducts as $product): ?>
        <article class="product-card">
            <img src="<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>">
            <div class="product-card-content">
                <p class="category"><?php echo e($product['category']); ?></p>
                <h3><?php echo e($product['name']); ?></h3>
                <p><?php echo e($product['description']); ?></p>
                <div class="product-card-footer">
                    <strong><?php echo money($product['price']); ?></strong>
                    <a class="button small" href="product.php?id=<?php echo (int) $product['id']; ?>">View</a>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<section class="info-grid">
    <div class="info-card">
        <h3>Fast setup</h3>
        <p>The project is organized into reusable PHP includes, page templates, and SQL seed data.</p>
    </div>
    <div class="info-card">
        <h3>Simple design</h3>
        <p>The UI uses plain layouts, neutral colors, and no animations so it stays easy to customize.</p>
    </div>
    <div class="info-card">
        <h3>Useful pages</h3>
        <p>You already have the main store flow: products, about, contact, cart, and checkout.</p>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
