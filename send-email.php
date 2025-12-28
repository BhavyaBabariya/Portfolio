<?php
// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 0 in production
ini_set('log_errors', 1);

// Set JSON header
header('Content-Type: application/json');

// Start output buffering to catch any errors
ob_start();

// CORS headers (adjust for your domain)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Load configuration
if (!file_exists('config.php')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Configuration file not found. Please create config.php']);
    exit;
}
require_once 'config.php';

// Check if PHPMailer is installed
if (!file_exists('vendor/autoload.php')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'PHPMailer not installed. Please run: composer install']);
    exit;
}

// Load PHPMailer
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
}

if (empty($subject)) {
    $errors[] = 'Subject is required';
}

if (empty($message)) {
    $errors[] = 'Message is required';
}

// If there are validation errors
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

try {
    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port = SMTP_PORT;
    $mail->CharSet = 'UTF-8';

    // Enable verbose debug output (disable in production)
    // $mail->SMTPDebug = 2;

    // Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress(TO_EMAIL, TO_NAME);
    
    // Reply-to set to sender's email
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Portfolio Contact: ' . $subject;
    
    // Email body
    $mail->Body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #f87652; color: white; padding: 20px; text-align: center; }
            .content { background-color: #f9f9f9; padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #333647; }
            .value { margin-top: 5px; padding: 10px; background-color: white; border-left: 3px solid #f87652; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Name:</div>
                    <div class='value'>{$name}</div>
                </div>
                <div class='field'>
                    <div class='label'>Email:</div>
                    <div class='value'>{$email}</div>
                </div>
                <div class='field'>
                    <div class='label'>Subject:</div>
                    <div class='value'>{$subject}</div>
                </div>
                <div class='field'>
                    <div class='label'>Message:</div>
                    <div class='value'>" . nl2br($message) . "</div>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";

    // Plain text version
    $mail->AltBody = "
    New Contact Form Submission
    
    Name: {$name}
    Email: {$email}
    Subject: {$subject}
    
    Message:
    {$message}
    ";

    // Send email
    $mail->send();
    
    // Success response
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. I will get back to you soon.'
    ]);

} catch (Exception $e) {
    // Clear any output before sending JSON
    ob_clean();
    
    // Error response
    http_response_code(500);
    $errorMessage = 'Sorry, there was an error sending your message. Please try again later.';
    
    // For debugging - uncomment to see actual error
    // $errorMessage = 'Error: ' . $e->getMessage();
    // if (isset($mail)) {
    //     $errorMessage .= ' | PHPMailer Error: ' . $mail->ErrorInfo;
    // }
    
    echo json_encode([
        'success' => false,
        'message' => $errorMessage
    ]);
}

// Clean output buffer
ob_end_flush();
?>

