<?php
// Email Configuration Example
// Copy this file to config.php and update with your actual credentials

// SMTP Configuration
define('SMTP_HOST', 'smtp.gmail.com'); // Change to your SMTP server
define('SMTP_USERNAME', 'your-email@gmail.com'); // Your email address
define('SMTP_PASSWORD', 'your-app-password'); // Your email password or app password
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); // 'tls' or 'ssl'

// Email Settings
define('FROM_EMAIL', 'your-email@gmail.com'); // Email address to send from
define('FROM_NAME', 'Portfolio Contact Form'); // Name to display as sender
define('TO_EMAIL', 'your-receiving-email@gmail.com'); // Your email address to receive messages
define('TO_NAME', 'Your Name'); // Your name

// Security
define('ALLOWED_ORIGINS', ['http://localhost', 'https://yourdomain.com']); // Add your domain
?>

