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

$identifier = $input['email'] ?? $input['contact_num'] ?? '';
$otp_input = isset($input['otp_input']) ? trim($input['otp_input']) : '';

if (empty($identifier) || empty($otp_input)) {
    http_response_code(400);
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
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Wrong Verification Code."]);
        exit();
    }

    if ($user['otp_expiry'] < $now) {
        http_response_code(400);
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

        echo json_encode(["status" => "success", "message" => "Account verified! Redirecting to Login."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Error in Database: " . $conn->error]);
    }
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "User not found."]);
}
?>