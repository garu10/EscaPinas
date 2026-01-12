<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once "../../php/connect.php"; 
date_default_timezone_set('Asia/Manila');

$email = $_POST['email'] ?? null;

if (!$email) {
    echo json_encode(["status" => "error", "message" => "Email missing from request."]);
    exit();
}

$sql = "SELECT user_id, contact_num FROM users WHERE email = '$email' LIMIT 1";
$res = mysqli_query($conn, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode(["status" => "error", "message" => "User not found for: " . $email]);
    exit();
}

$user = mysqli_fetch_assoc($res);
$user_id = $user['user_id']; 
$contact_num = $user['contact_num'];

$new_otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));
$message_text = "EscaPinas: Your new code is $new_otp.This is valid within a minute.";

$update_sql = "UPDATE users SET verification_code='$new_otp', otp_expiry='$expiry' WHERE user_id='$user_id'";
$update_query = mysqli_query($conn, $update_sql);

if (!$update_query) {
    echo json_encode(["status" => "error", "message" => "Database Update Failed: " . mysqli_error($conn)]);
    exit();
}

function triggerSMS($to, $msg) {
    $to = preg_replace('/[^0-9+]/', '', $to);
    if (substr($to, 0, 1) == "0") { 
        $to = "+63" . substr($to, 1); 
    }
    
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = json_encode(["phoneNumbers" => [$to], "textMessage" => ["text" => $msg]]);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

$smsResponse = triggerSMS($contact_num, $message_text);
$responseData = json_decode($smsResponse, true);
$api_id = $responseData['id'] ?? null;

$logStatus = $api_id ? 'sent' : 'failed';
$log_sql = "INSERT INTO sms_logs (user_id, contact_num, sms_type, message_content, status, message_id) 
            VALUES ('$user_id', '$contact_num', 'OTP', '$message_text', '$logStatus', '$api_id')";
mysqli_query($conn, $log_sql);

if ($api_id) {
    echo json_encode(["status" => "success", "message" => "New code sent!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Nag-save ang code pero may problema sa pag-send ng SMS."]);
}
exit();