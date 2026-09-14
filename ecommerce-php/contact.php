<?php
$pageTitle = 'Contact Us';
require_once __DIR__ . '/includes/header.php';
?>
<section class="section-heading stacked narrow">
    <div>
        <p class="eyebrow">Support</p>
        <h1>Contact Us</h1>
        <p>Send a message and it will be stored in the SQL database.</p>
    </div>
</section>
<section class="contact-layout">
    <div class="info-card">
        <h3>Store Contact</h3>
        <p>Email: support@northstarstore.com</p>
        <p>Phone: +1 555 240 1890</p>
        <p>Address: 245 Market Street, San Francisco, CA</p>
    </div>
    <form class="form-card" action="actions/submit_contact.php" method="post">
        <label for="name">Full Name</label>
        <input id="name" name="name" type="text" required>
        <label for="email">Email Address</label>
        <input id="email" name="email" type="email" required>
        <label for="subject">Subject</label>
        <input id="subject" name="subject" type="text" required>
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" required></textarea>
        <button type="submit" class="button primary">Send Message</button>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
