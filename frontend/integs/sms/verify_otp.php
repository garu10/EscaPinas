<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

$target_path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'connect.php';
$include_path = realpath($target_path);

if (!$include_path || !file_exists($include_path)) {
    echo json_encode(["status" => "error", "message" => "Connection file not found."]);
    exit();
}

require_once $include_path;
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
    exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$otp_input = isset($_POST['otp_input']) ? trim($_POST['otp_input']) : '';

if (empty($email) || empty($otp_input)) {
    echo json_encode(["status" => "error", "message" => "Email or OTP not provided."]);
    exit();
}

$now = date("Y-m-d H:i:s");

$stmt = $conn->prepare("SELECT verification_code, otp_expiry FROM users WHERE email = ? LIMIT 1");
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Database error."]);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if ($user['verification_code'] !== $otp_input) {
        echo json_encode(["status" => "error", "message" => "Maling verification code."]);
        exit();
    }

    if ($user['otp_expiry'] < $now) {
        echo json_encode(["status" => "error", "message" => "Ang iyong OTP ay expired. I-click ang Resend Code."]);
        exit();
    }

    $updateStmt = $conn->prepare("UPDATE users SET is_verified = 1, verification_code = NULL, otp_expiry = NULL WHERE email = ?");
    $updateStmt->bind_param("s", $email);
    if ($updateStmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Account verified! Redirecting to login..."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to verify account."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Email not found."]);
}

exit();
?>
