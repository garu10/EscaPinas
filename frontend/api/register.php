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

include("../php/connect.php");
include("../integs/api/api-connect/api-connect.php");

function formatPhone($number) {
    $number = preg_replace('/[^0-9+]/', '', $number);
    if (substr($number, 0, 1) == "0") {
        $number = "+63" . substr($number, 1);
    }
    return $number;
}

// Function to check if email exists in BookStack API
function checkEmailInBookStack($email) {
    $api_url = BOOKSTACK_API_USERS;
    $admin_username = "Hiro Setsuya";
    $admin_password = "Adrian1#";

    try {
        $context = stream_context_create([
            "http" => [
                "header" => "Authorization: Basic " . base64_encode("$admin_username:$admin_password")
            ]
        ]);
        $response = @file_get_contents($api_url, false, $context);
        if ($response === false) {
            return false;
        }
        if (empty($response)) {
            return false;
        }
        $data = json_decode($response, true);
        if (!is_array($data)) {
            return false;
        }
        if (isset($data['user_id'])) {
            if ($data['email'] === $email) {
                return true;
            }
        } elseif (is_array($data) && count($data) > 0) {
            $first_key = array_key_first($data);
            if (isset($data[$first_key]['user_id'])) {
                foreach ($data as $user) {
                    if (is_array($user) && isset($user['email']) && $user['email'] === $email) {
                        return true;
                    }
                }
            }
        }
        return false;
    } catch (Exception $e) {
        error_log("BookStack API Exception: " . $e->getMessage());
        return false;
    }
}

function sendSMS($to, $msg) {
    $to = formatPhone($to);
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = ["phoneNumbers" => [$to], "textMessage" => ["text" => $msg]];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    if ($result === false) {
        error_log("SMS Error: " . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
$required_fields = ['first_name', 'last_name', 'user_name', 'contact_num', 'email', 'password', 'confirm_password'];
foreach ($required_fields as $field) {
    if (!isset($input[$field]) || empty(trim($input[$field]))) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => "Missing or empty field: $field"]);
        exit;
    }
}

$fname = mysqli_real_escape_string($conn, trim($input['first_name']));
$last_name = mysqli_real_escape_string($conn, trim($input['last_name']));
$user_name = mysqli_real_escape_string($conn, trim($input['user_name']));
$middle_initial = isset($input['middle_initial']) ? mysqli_real_escape_string($conn, trim($input['middle_initial'])) : '';
$contact_num = mysqli_real_escape_string($conn, trim($input['contact_num']));
$province = isset($input['province']) ? mysqli_real_escape_string($conn, trim($input['province'])) : '';
$city = isset($input['city']) ? mysqli_real_escape_string($conn, trim($input['city'])) : '';
$email = mysqli_real_escape_string($conn, trim($input['email']));
$password = $input['password'];
$confirm_password = $input['confirm_password'];

// Validate password match
if ($password !== $confirm_password) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
    exit;
}

// Check if email exists in EscaPinas database
$checkEmail = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
$result = executeQuery($checkEmail);
if ($result && mysqli_num_rows($result) > 0) {
    http_response_code(409);
    echo json_encode(['status' => 'error', 'message' => 'Email already exists in EscaPinas']);
    exit;
}

// Check if email exists in BookStack API
if (checkEmailInBookStack($email)) {
    http_response_code(409);
    echo json_encode(['status' => 'error', 'message' => 'Email already exists in BookStack']);
    exit;
}

// Proceed with registration
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$otp_code = rand(100000, 999999);
date_default_timezone_set('Asia/Manila');
$expiry_time = date("Y-m-d H:i:s", strtotime('+1 minute'));

$insertUser = "INSERT INTO users (first_name, last_name, middle_initial, contact_num, province, city, username, email, password, role, is_verified, verification_code, otp_expiry) 
               VALUES ('$fname', '$last_name', '$middle_initial', '$contact_num', '$province', '$city', '$user_name', '$email', '$hashed_password', 'user', 0, '$otp_code', '$expiry_time')";

if (executeQuery($insertUser)) {
    $new_user_id = mysqli_insert_id($conn);
    $message_content = "EscaPinas: Ang iyong code ay $otp_code. Valid ito sa loob ng 1 minuto.";

    $smsResponse = sendSMS($contact_num, $message_content);
    $responseData = json_decode($smsResponse, true);
    $api_message_id = isset($responseData['id']) ? $responseData['id'] : null;

    $logStatus = $api_message_id ? 'sent' : 'failed';
    $insertLog = "INSERT INTO sms_logs (user_id, contact_num, sms_type, message_content, status, message_id) 
                  VALUES ('$new_user_id', '$contact_num', 'OTP', '$message_content', '$logStatus', '$api_message_id')";

    executeQuery($insertLog);

    echo json_encode([
        'status' => 'success',
        'message' => 'Registration successful. Please verify your account with the OTP sent to your phone.',
        'user_id' => $new_user_id,
        'email' => $email,
        'otp_expiry' => $expiry_time
    ]);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
}
?>