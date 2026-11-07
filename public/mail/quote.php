<?php
/**
 * Agrovia Farm & Agriculture Solutions - Quote & Wholesale Order Processor
 * Handles incoming quote and consultation requests, performs input sanitization,
 * generates unique inquiry tracking IDs, and logs to mail/logs/quote_requests.log.
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

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data) || empty($data)) {
    $data = $_POST;
}

$name     = isset($data['name']) ? trim(strip_tags($data['name'])) : '';
$farm     = isset($data['farm']) ? trim(strip_tags($data['farm'])) : (isset($data['company']) ? trim(strip_tags($data['company'])) : 'Private Client / Farm');
$email    = isset($data['email']) ? trim(filter_var($data['email'], FILTER_SANITIZE_EMAIL)) : '';
$phone    = isset($data['phone']) ? trim(strip_tags($data['phone'])) : '';
$service  = isset($data['service']) ? trim(strip_tags($data['service'])) : 'Crop Cultivation & Harvest';
$quantity = isset($data['quantity']) ? trim(strip_tags($data['quantity'])) : (isset($data['budget']) ? trim(strip_tags($data['budget'])) : 'Standard Family CSA Box');
$delivery = isset($data['delivery']) ? trim(strip_tags($data['delivery'])) : (isset($data['timeline']) ? trim(strip_tags($data['timeline'])) : 'Within 48 Hours');
$notes    = isset($data['notes']) ? trim(strip_tags($data['notes'])) : (isset($data['scope']) ? trim(strip_tags($data['scope'])) : '');

$errors = [];
if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Contact name is required (minimum 2 characters).';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid email address is required.';
}
if (empty($phone) || strlen($phone) < 7) {
    $errors[] = 'A valid phone number is required for dispatch.';
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

$quoteId = 'AGRO-ORD-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
$timestamp = date('Y-m-d H:i:s T');

$logEntry = [
    'quote_id'  => $quoteId,
    'timestamp' => $timestamp,
    'name'      => $name,
    'farm_org'  => $farm,
    'email'     => $email,
    'phone'     => $phone,
    'service'   => $service,
    'quantity'  => $quantity,
    'delivery'  => $delivery,
    'notes'     => $notes,
    'ip'        => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
];

$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$logFile = $logDir . '/quote_requests.log';
@file_put_contents($logFile, json_encode($logEntry, JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);

echo json_encode([
    'success'   => true,
    'quote_id'  => $quoteId,
    'message'   => "Order / quote estimate successfully registered! Ref Code: {$quoteId}. Our farm manager will confirm harvest availability with you shortly.",
    'timestamp' => $timestamp
]);
exit;
