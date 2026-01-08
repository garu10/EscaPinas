<?php
function sendSMS($rawNumber, $message) {
    $number = preg_replace('/[^0-9]/', '', $rawNumber);

    if (strlen($number) === 11 && substr($number, 0, 2) === '09') {
        $number = '63' . substr($number, 1);
    }

    if (strlen($number) !== 12 || substr($number, 0, 2) !== '63') {
        return "INVALID NUMBER FORMAT: " . $rawNumber;
    }

    $number = '+' . $number;
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";

    $payload = [
        "phoneNumbers" => [$number],
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

    return "HTTP $httpCode | $response";
}

function sendBookingSMS($rawNumber, $ref) {
    $message = "Thank you for booking with EscaPinas! We value your experience and would love your feedback. Reply to this message to share your thoughts. Ref: " . $ref;
    return sendSMS($rawNumber, $message);
}
?>