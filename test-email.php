<?php
// Simple test file to check if PHP and PHPMailer are working
header('Content-Type: application/json');

echo json_encode([
    'success' => true,
    'message' => 'PHP is working!',
    'php_version' => phpversion(),
    'config_exists' => file_exists('config.php'),
    'vendor_exists' => file_exists('vendor/autoload.php'),
    'post_data' => $_POST
]);

