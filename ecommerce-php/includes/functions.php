<?php
require_once __DIR__ . '/db.php';

function setFlash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash()
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function getCurrentCartToken()
{
    if (!isset($_SESSION['cart_token'])) {
        $_SESSION['cart_token'] = bin2hex(random_bytes(16));
    }

    return $_SESSION['cart_token'];
}

function ensureCart()
{
    $database = db();

    if (!$database) {
        return null;
    }

    $token = getCurrentCartToken();
    $statement = $database->prepare('SELECT id FROM carts WHERE session_token = ? LIMIT 1');
    $statement->bind_param('s', $token);
    $statement->execute();
    $result = $statement->get_result();
    $cart = $result->fetch_assoc();
    $statement->close();

    if ($cart) {
        return (int) $cart['id'];
    }

    $statement = $database->prepare('INSERT INTO carts (session_token) VALUES (?)');
    $statement->bind_param('s', $token);
    $statement->execute();
    $cartId = $statement->insert_id;
    $statement->close();

    return $cartId;
}

function fetchProducts($limit = null)
{
    $database = db();

    if (!$database) {
        return [];
    }

    $sql = 'SELECT id, name, description, price, image, category FROM products ORDER BY id DESC';

    if ($limit !== null) {
        $sql .= ' LIMIT ' . (int) $limit;
    }

    $result = $database->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function fetchProduct($id)
{
    $database = db();

    if (!$database) {
        return null;
    }

    $statement = $database->prepare('SELECT id, name, description, price, image, category FROM products WHERE id = ? LIMIT 1');
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();
    $product = $result->fetch_assoc();
    $statement->close();

    return $product ?: null;
}

function fetchCartItems()
{
    $database = db();
    $cartId = ensureCart();

    if (!$database || !$cartId) {
        return [];
    }

    $statement = $database->prepare('SELECT cart_items.id, cart_items.quantity, products.id AS product_id, products.name, products.price, products.image FROM cart_items JOIN products ON products.id = cart_items.product_id WHERE cart_items.cart_id = ? ORDER BY cart_items.id DESC');
    $statement->bind_param('i', $cartId);
    $statement->execute();
    $result = $statement->get_result();
    $items = $result->fetch_all(MYSQLI_ASSOC);
    $statement->close();

    return $items;
}

function cartTotals()
{
    $items = fetchCartItems();
    $count = 0;
    $subtotal = 0;

    foreach ($items as $item) {
        $count += (int) $item['quantity'];
        $subtotal += ((float) $item['price']) * ((int) $item['quantity']);
    }

    return [
        'items' => $items,
        'count' => $count,
        'subtotal' => $subtotal,
    ];
}

function addItemToCart($productId, $quantity)
{
    $database = db();
    $cartId = ensureCart();

    if (!$database || !$cartId) {
        return false;
    }

    $statement = $database->prepare('SELECT id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ? LIMIT 1');
    $statement->bind_param('ii', $cartId, $productId);
    $statement->execute();
    $result = $statement->get_result();
    $existing = $result->fetch_assoc();
    $statement->close();

    if ($existing) {
        $newQuantity = (int) $existing['quantity'] + $quantity;
        $statement = $database->prepare('UPDATE cart_items SET quantity = ? WHERE id = ?');
        $statement->bind_param('ii', $newQuantity, $existing['id']);
        $success = $statement->execute();
        $statement->close();
        return $success;
    }

    $statement = $database->prepare('INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)');
    $statement->bind_param('iii', $cartId, $productId, $quantity);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function updateCartQuantity($itemId, $quantity)
{
    $database = db();

    if (!$database) {
        return false;
    }

    if ($quantity <= 0) {
        $statement = $database->prepare('DELETE FROM cart_items WHERE id = ?');
        $statement->bind_param('i', $itemId);
        $success = $statement->execute();
        $statement->close();
        return $success;
    }

    $statement = $database->prepare('UPDATE cart_items SET quantity = ? WHERE id = ?');
    $statement->bind_param('ii', $quantity, $itemId);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function removeCartItem($itemId)
{
    $database = db();

    if (!$database) {
        return false;
    }

    $statement = $database->prepare('DELETE FROM cart_items WHERE id = ?');
    $statement->bind_param('i', $itemId);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function saveContactMessage($name, $email, $subject, $message)
{
    $database = db();

    if (!$database) {
        return false;
    }

    $statement = $database->prepare('INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)');
    $statement->bind_param('ssss', $name, $email, $subject, $message);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function createOrder($customerName, $customerEmail, $customerPhone, $address)
{
    $database = db();
    $cart = cartTotals();

    if (!$database || empty($cart['items'])) {
        return false;
    }

    $statement = $database->prepare('INSERT INTO orders (customer_name, customer_email, customer_phone, shipping_address, total_amount) VALUES (?, ?, ?, ?, ?)');
    $statement->bind_param('ssssd', $customerName, $customerEmail, $customerPhone, $address, $cart['subtotal']);
    $success = $statement->execute();
    $orderId = $statement->insert_id;
    $statement->close();

    if (!$success) {
        return false;
    }

    foreach ($cart['items'] as $item) {
        $lineTotal = ((float) $item['price']) * ((int) $item['quantity']);
        $statement = $database->prepare('INSERT INTO order_items (order_id, product_id, quantity, price, line_total) VALUES (?, ?, ?, ?, ?)');
        $statement->bind_param('iiidd', $orderId, $item['product_id'], $item['quantity'], $item['price'], $lineTotal);
        $statement->execute();
        $statement->close();
    }

    $cartId = ensureCart();
    if ($cartId) {
        $statement = $database->prepare('DELETE FROM cart_items WHERE cart_id = ?');
        $statement->bind_param('i', $cartId);
        $statement->execute();
        $statement->close();
    }

    return $orderId;
}

function money($amount)
{
    return '$' . number_format((float) $amount, 2);
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
