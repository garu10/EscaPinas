<?php
include '../../php/connect.php'; 

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

$timestamp = date("Y-m-d H:i:s");
$logFile = __DIR__ . "/sms_log.txt";
file_put_contents($logFile, "[$timestamp] RECEIVED: " . $rawData . PHP_EOL, FILE_APPEND);

if ($data && isset($data['payload'])) {
    $sender_number = $data['payload']['phoneNumber'];
    $message = strtoupper(trim($data['payload']['message']));    

    if ($message === 'YES') {
        
        $last10Digits = substr($sender_number, -10);
        
        $sql = "UPDATE users SET is_verified = 1 
                WHERE contact_num LIKE '%$last10Digits' 
                AND is_verified = 0"; 
        
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                $final_msg = "EscaPinas: Account confirmed! Pwede ka na mag-login. Welcome, Explorer!";
                sendSMS($sender_number, $final_msg);
                file_put_contents($logFile, "[$timestamp] DB SUCCESS: Verified number ending in $last10Digits" . PHP_EOL, FILE_APPEND);
            } else {
                file_put_contents($logFile, "[$timestamp] DB IGNORE: Number $last10Digits not found or already verified." . PHP_EOL, FILE_APPEND);
            }
        } else {
            file_put_contents($logFile, "[$timestamp] DB ERROR: " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
        }
    }
}

http_response_code(200);
echo json_encode(["status" => "ok", "received" => true]);

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
    
    // SSL FIX para sa HTTPS connections
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    
    // Log ang resulta ng pag-send
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        file_put_contents(__DIR__ . "/sms_log.txt", "[".date("Y-m-d H:i:s")."] cURL ERROR: $error_msg" . PHP_EOL, FILE_APPEND);
    } else {
        file_put_contents(__DIR__ . "/sms_log.txt", "[".date("Y-m-d H:i:s")."] SEND RESPONSE: $response" . PHP_EOL, FILE_APPEND);
    }
    
    curl_close($ch);
    return $response;
}
?>