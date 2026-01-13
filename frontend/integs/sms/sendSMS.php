<?php
include_once("../frontend/php/connect.php");

function sendSMS($rawNumber, $message, $user_id, $type = 'Review') {
    global $conn; 

    $number = preg_replace('/[^0-9]/', '', $rawNumber);
    if (strlen($number) === 11 && substr($number, 0, 2) === '09') {
        $number = '63' . substr($number, 1);
    }

    if (strlen($number) !== 12 || substr($number, 0, 2) !== '63') {
        return "INVALID NUMBER FORMAT: " . $rawNumber;
    }

    $formattedNumber = '+' . $number;
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";

    $payload = [
        "phoneNumbers" => [$formattedNumber],
        "textMessage" => ["text" => $message]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $resData = json_decode($response, true);
    $messageId = $resData['id'] ?? null;
    $status = ($httpCode == 200 || $httpCode == 201) ? 'sent' : 'failed';

    if (!empty($user_id)) {
        try {
            $stmt = $conn->prepare("INSERT INTO sms_logs (user_id, contact_num, sms_type, message_content, status, message_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $rawNumber, $type, $message, $status, $messageId);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            error_log("SMS Log DB Error: " . $e->getMessage());
            return "SMS Sent but Logging Failed: Foreign Key constraint violated.";
        }
    }

    return "HTTP $httpCode | $response";
}

function sendBookingSMS($rawNumber, $ref, $user_id) {
    $message = "Thank you for booking with EscaPinas! We value your experience and would love your feedback. Reply to this message to share your thoughts. Ref: " . $ref;
    return sendSMS($rawNumber, $message, $user_id, 'Review');
}
?>