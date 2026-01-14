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

session_start();
require_once "../php/connect.php";
include "../integs/api/api-connect/api-connect.php";

function sendSMS($to, $msg) {
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = ["phoneNumbers" => [$to], "textMessage" => ["text" => $msg]];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);
}

function checkBookStackUser($identifier) {
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
            error_log("BookStack API failed to retrieve data");
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
            if ($data['email'] === $identifier || $data['username'] === $identifier) {
                return $data;
            }
        } elseif (is_array($data) && count($data) > 0) {
            $first_key = array_key_first($data);
            if (isset($data[$first_key]['user_id'])) {
                foreach ($data as $user) {
                    if (is_array($user) && (isset($user['email']) && $user['email'] === $identifier) || (isset($user['username']) && $user['username'] === $identifier)) {
                        return $user;
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

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
    exit;
}

$identifier = $input['email'] ?? '';
$password = $input['password'] ?? '';

if (empty($identifier) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Email/Username and password are required']);
    exit;
}

// First, check if user exists in EscaPinas database
$get_user = "SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier' LIMIT 1";
$result = executeQuery( $get_user);

$user_found = false;
$user_data = null;

if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    $user_found = true;
} else {
    // Check BookStack API
    $bookstack_user = checkBookStackUser($identifier);
    if ($bookstack_user) {
        $user_data = $bookstack_user;
        $user_found = true;
    }
}

if (!$user_found) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'No account found with that Username or Email!']);
    exit;
}

// Check if account is verified
$is_verified = isset($user_data['is_account_verified']) ? $user_data['is_account_verified'] : (isset($user_data['is_verified']) ? $user_data['is_verified'] : 0);

if ($is_verified == 0) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Account not verified. Please verify your account first.', 'resend_email' => $user_data['email']]);
    exit;
}

// Verify password
$password_hash = isset($user_data['password']) ? $user_data['password'] : (isset($user_data['password_hash']) ? $user_data['password_hash'] : '');

if (empty($password_hash)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Account password not found in system!']);
    exit;
}

if (!password_verify($password, $password_hash)) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
    exit;
}

// Success - set session
$user_name = $user_data['user_name'] ?? $user_data['username'] ?? '';
$email = mysqli_real_escape_string($conn, $user_data['email']);
$phone_number = mysqli_real_escape_string($conn, $user_data['phone_number'] ?? $user_data['contact_num'] ?? '');
$role = $user_data['role'] ?? 'user';

// If from BookStack, sync to EscaPinas database
$check_user = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";
$check_result = executeQuery( $check_user);

if ($check_result && mysqli_num_rows($check_result) > 0) {
    $existing_user = mysqli_fetch_assoc($check_result);
    $_SESSION['user_id'] = $existing_user['user_id'];
} else {
    $insert_query = "INSERT INTO users (username, email, contact_num, role, password, is_verified) VALUES ('$user_name', '$email', '$phone_number', '$role', '$password_hash', '$is_verified')";
    if (executeQuery( $insert_query)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to sync user data']);
        exit;
    }
}

echo json_encode([
    'status' => 'success',
    'message' => 'Login successful',
    'user_id' => $_SESSION['user_id'],
    'email' => $email,
    'role' => $role
]);
?>