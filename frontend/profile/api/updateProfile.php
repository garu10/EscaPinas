<?php
ob_start(); 
session_start();

header('Content-Type: application/json');

// This starts at /api/ and goes:
// 1 level up -> /profile/
// 2 levels up -> /frontend/
// Then looks for /php/connect.php inside /frontend/
$conn_file = dirname(__DIR__, 2) . "/php/connect.php";

if (!file_exists($conn_file)) {
    ob_clean();
    echo json_encode([
        'success' => false, 
        'error' => 'File not found. PHP looked at: ' . $conn_file
    ]);
    exit;
}

require_once($conn_file);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Invalid method']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Session expired']);
    exit;
}

$uid = $_SESSION['user_id'];
$column = $_POST['column'] ?? '';
$value = $_POST['value'] ?? '';

// Mapping UI keys to Database Columns
$allowed_columns = [
    'first_name'    => 'first_name',
    'last_name'     => 'last_name',
    'address'       => 'province', 
    'email_address' => 'email',
    'phone_number'  => 'contact_num'
];

if (!array_key_exists($column, $allowed_columns)) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Invalid field']);
    exit;
}

$db_col = $allowed_columns[$column];

// 2. Use Standard mysqli prepared statements (Safest)
try {
    $stmt = $conn->prepare("UPDATE users SET $db_col = ? WHERE user_id = ?");
    $stmt->bind_param("si", $value, $uid);
    
    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['success' => true]);
    } else {
        throw new Exception($stmt->error);
    }
} catch (Exception $e) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

exit;