<?php
include '../../php/connect.php'; 

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

$timestamp = date("Y-m-d H:i:s");
$logFile = __DIR__ . "/sms_log.txt";

file_put_contents($logFile, "[$timestamp] CALLBACK RECEIVED: " . $rawData . PHP_EOL, FILE_APPEND);

if ($data && isset($data['status'])) {  
    $messageId = $data['id'] ?? 'N/A';
    $status = $data['status']; 
    
    file_put_contents($logFile, "[$timestamp] SMS ID: $messageId | STATUS: $status" . PHP_EOL, FILE_APPEND);
}

http_response_code(200);
echo json_encode(["status" => "ok", "message" => "Callback logged"]);

function sendSMS($to, $msg) {
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = [
        "phoneNumbers" => [$to],
        "textMessage" => ["text" => $msg]
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>