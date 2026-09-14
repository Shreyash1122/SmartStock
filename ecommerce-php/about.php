<?php
$pageTitle = 'About Us';
require_once __DIR__ . '/includes/header.php';
?>
<section class="section-heading stacked narrow">
    <div>
        <p class="eyebrow">About</p>
        <h1>About Us</h1>
        <p>Northstar Store is a simple ecommerce demo built for teams that want a clean storefront structure with SQL-backed product and customer data.</p>
    </div>
</section>
<section class="info-grid two-columns">
    <div class="info-card">
        <h3>What we offer</h3>
        <p>We focus on practical home, workspace, and lifestyle products that fit a straightforward online shopping experience.</p>
    </div>
    <div class="info-card">
        <h3>How the site works</h3>
        <p>Products are stored in SQL, cart activity is handled through PHP, and customer orders are saved into database tables for later use.</p>
    </div>
    <div class="info-card">
        <h3>Why the layout is simple</h3>
        <p>This project avoids motion-heavy styling so the UI stays readable, fast, and easy to extend.</p>
    </div>
    <div class="info-card">
        <h3>Who this is for</h3>
        <p>It works well as a starter project for learning PHP, SQL, and multi-page ecommerce basics.</p>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
