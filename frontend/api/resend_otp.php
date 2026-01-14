<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

require_once "../php/connect.php";
date_default_timezone_set('Asia/Manila');

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit;
}

$email = $input['email'] ?? null;

if (!$email) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Email missing from request."]);
    exit();
}

$sql = "SELECT user_id, contact_num FROM users WHERE email = '$email' LIMIT 1";
$res = executeQuery( $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "User not found for: " . $email]);
    exit();
}

$user = mysqli_fetch_assoc($res);
$user_id = $user['user_id'];
$contact_num = $user['contact_num'];

$new_otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));
$message_text = "EscaPinas: Your new code is $new_otp. This is valid within a minute.";

$update_sql = "UPDATE users SET verification_code='$new_otp', otp_expiry='$expiry' WHERE user_id='$user_id'";
$update_query = executeQuery( $update_sql);

if (!$update_query) {
    http_response_code(500);
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

    $result = curl_exec($ch);
    if ($result === false) {
        error_log("SMS Error: " . curl_error($ch));
        return false;
    }
    curl_close($ch);
    return $result;
}

$sms_result = triggerSMS($contact_num, $message_text);

if ($sms_result) {
    $log_sql = "INSERT INTO sms_logs (user_id, contact_num, sms_type, message_content, status, message_id) VALUES ('$user_id', '$contact_num', 'OTP', '$message_text', 'sent', NULL)";
    executeQuery( $log_sql);
    echo json_encode(["status" => "success", "message" => "New OTP sent successfully."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to send SMS."]);
}
?>