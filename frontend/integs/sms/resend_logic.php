<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once "../../php/connect.php";
date_default_timezone_set('Asia/Manila');

function formatPhone($number) {
    $number = preg_replace('/[^0-9+]/', '', $number);
    if (substr($number, 0, 1) === "0") {
        $number = "+63" . substr($number, 1);
    }
    return $number;
}

if (empty($_POST['email'])) {
    echo json_encode(["status"=>"error","message"=>"Email missing"]);
    exit();
}

$email = $_POST['email'];

$stmt = $conn->prepare("SELECT contact_num FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode(["status"=>"error","message"=>"Email not found"]);
    exit();
}

$user = $res->fetch_assoc();
$phone = formatPhone($user['contact_num']);

$new_otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));

$up = $conn->prepare("UPDATE users SET verification_code=?, otp_expiry=? WHERE email=?");
$up->bind_param("sss", $new_otp, $expiry, $email);
$up->execute();

$url = "https://api.sms-gate.app/3rdparty/v1/messages";
$payload = json_encode([
    "phoneNumbers" => [$phone],
    "textMessage" => [
        "text" => "EscaPinas: Ang iyong bagong verification code ay $new_otp. Valid ito sa loob ng 1 minuto."
    ]
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode([
        "status" => "error",
        "message" => "SMS Error: " . curl_error($ch)
    ]);
    exit();
}

curl_close($ch);

echo json_encode([
    "status" => "success",
    "message" => "OTP sent successfully"
]);
exit();
