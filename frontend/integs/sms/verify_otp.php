<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); 
header('Content-Type: application/json');

require_once "../../php/connect.php";
date_default_timezone_set('Asia/Manila');

$identifier = $_POST['email'] ?? $_POST['contact_num'] ?? '';
$otp_input = isset($_POST['otp_input']) ? trim($_POST['otp_input']) : '';

if (empty($identifier) || empty($otp_input)) {
    echo json_encode(["status" => "error", "message" => "Email/Contact or OTP not provided."]);
    exit();
}

$now = date("Y-m-d H:i:s");

$stmt = $conn->prepare("SELECT user_id, contact_num, verification_code, otp_expiry FROM users WHERE email = ? OR contact_num = ? LIMIT 1");
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $user_id = $user['user_id'];
    $phone = $user['contact_num'];

    if ($user['verification_code'] !== $otp_input) {
        echo json_encode(["status" => "error", "message" => "Wrong Verification Code."]);
        exit();
    }

    if ($user['otp_expiry'] < $now) {
        echo json_encode(["status" => "error", "message" => "Code already expired. Resend new."]);
        exit();
    }

    $updateStmt = $conn->prepare("UPDATE users SET is_verified = 1, verification_code = NULL, otp_expiry = NULL WHERE user_id = ?");
    $updateStmt->bind_param("i", $user_id);
    
    if ($updateStmt->execute()) {
        
        $log_msg = "User successfully verified their account using OTP.";
        $log_stmt = $conn->prepare("INSERT INTO sms_logs (user_id, contact_num, sms_type, message_content, status) VALUES (?, ?, 'OTP', ?, 'delivered')");
        $log_stmt->bind_param("iss", $user_id, $phone, $log_msg);
        $log_stmt->execute();

        echo json_encode(["status" => "success", "message" => "Account verified!Redirecting to Login."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error in Database: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No account can be found."]);
}
exit();