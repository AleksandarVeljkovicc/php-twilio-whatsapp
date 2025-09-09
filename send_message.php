<?php
require_once __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$sid = $_ENV['TWILIO_SID'];
$token = $_ENV['TWILIO_TOKEN'];
$twilio_whatsapp_number = $_ENV['TWILIO_WHATSAPP_NUMBER'];
$expected_api_key = $_ENV['API_KEY'];


$headers = getallheaders();
if (!isset($headers['Authorization']) || $headers['Authorization'] !== "Bearer $expected_api_key") {
    http_response_code(401); 
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}


$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['phone']) || !isset($input['message'])) {
    http_response_code(400); 
    echo json_encode(['error' => 'Missing phone or message']);
    exit;
}


if (!preg_match('/^\+\d{8,15}$/', $input['phone'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid phone format']);
    exit;
}

$to = 'whatsapp:' . $input['phone'];
$message = $input['message'];


try {
    $client = new Client($sid, $token);
    $client->messages->create($to, [
        'from' => $twilio_whatsapp_number,
        'body' => $message
    ]);

    echo json_encode(['status' => 'Message sent']);
} catch (Exception $e) {
    http_response_code(500);
    error_log("Twilio Error: " . $e->getMessage());
    echo json_encode(['error' => 'Internal error']);
}
