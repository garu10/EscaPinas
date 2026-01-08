<?php
include_once "php/connect.php";
include_once "integs/sms/sendSMS.php";

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$senderNumber = $data['address'] ?? ($data['sender'] ?? '');
$userMessage = $data['text'] ?? ($data['body'] ?? '');

if (!empty($senderNumber)) {
    
    $logFile = __DIR__ . "/integs/sms/feedback_log.txt";
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logFile, "[$timestamp] FROM: $senderNumber | MSG: $userMessage\n", FILE_APPEND);

    $replyContent = "EscaPinas: Maraming salamat sa iyong feedback! Malaking tulong ito para mapaganda pa ang aming serbisyo. Have a great day!";
    
    sendSMS($senderNumber, $replyContent);
}

http_response_code(200);
echo "OK";
?>