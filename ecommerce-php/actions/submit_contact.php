<?php
require_once __DIR__ . '/../includes/functions.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    setFlash('error', 'Please fill in all contact form fields.');
    header('Location: ../contact.php');
    exit;
}

if (saveContactMessage($name, $email, $subject, $message)) {
    setFlash('success', 'Your message has been saved successfully.');
} else {
    setFlash('error', 'Unable to save your message right now.');
}

header('Location: ../contact.php');
exit;
