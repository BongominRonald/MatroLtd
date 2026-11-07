<?php
/**
 * Agrovia Farm & Agriculture Solutions - Contact Inquiry Processor
 * Handles incoming AJAX submissions, performs input sanitization,
 * generates unique inquiry tracking IDs, and logs to mail/logs/contact_inquiries.log.
 */

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method Not Allowed. Only POST requests are permitted.'
    ]);
    exit;
}

// Support both application/json and application/x-www-form-urlencoded
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data) || empty($data)) {
    $data = $_POST;
}

$name    = isset($data['name']) ? trim(strip_tags($data['name'])) : '';
$email   = isset($data['email']) ? trim(filter_var($data['email'], FILTER_SANITIZE_EMAIL)) : '';
$phone   = isset($data['phone']) ? trim(strip_tags($data['phone'])) : '';
$subject = isset($data['subject']) ? trim(strip_tags($data['subject'])) : 'General Farm & Produce Inquiry';
$message = isset($data['message']) ? trim(strip_tags($data['message'])) : '';

// Validation
$errors = [];
if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Full name must contain at least 2 characters.';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid corporate or personal email address is required.';
}
if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters long.';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors),
        'errors'  => $errors
    ]);
    exit;
}

// Generate unique tracking ticket
$ticketId = 'AGRO-INQ-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
$timestamp = date('Y-m-d H:i:s T');

$logEntry = [
    'ticket_id' => $ticketId,
    'timestamp' => $timestamp,
    'name'      => $name,
    'email'     => $email,
    'phone'     => $phone,
    'subject'   => $subject,
    'message'   => $message,
    'ip'        => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
];

$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$logFile = $logDir . '/contact_inquiries.log';
@file_put_contents($logFile, json_encode($logEntry, JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);

// Success JSON response
echo json_encode([
    'success'   => true,
    'ticket_id' => $ticketId,
    'message'   => "Thank you, {$name}! Your agricultural inquiry has been received (Ref: {$ticketId}). Our farm specialists will contact you within 24 hours.",
    'timestamp' => $timestamp
]);
exit;
