# Northstar Store

This folder contains a simple multi-page ecommerce website built with PHP, HTML, CSS, JavaScript, and SQL.

## Pages

- `index.php`
- `products.php`
- `product.php`
- `about.php`
- `contact.php`
- `cart.php`
- `checkout.php`

## Setup

1. Create a MySQL database by importing `database/schema.sql`.
2. Update database credentials in `includes/config.php` if needed.
3. Serve the `ecommerce-php` folder through a PHP-enabled local server.

## Database Features

- Products are loaded from SQL.
- Cart items are stored in SQL by session token.
- Contact form submissions are saved in SQL.
- Orders and order items are saved in SQL.
