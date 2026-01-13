<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "../../php/connect.php";

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Handle GET requests (retrieve users)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get single user by ID
    if (isset($_GET['id'])) {
        $user_id = intval($_GET['id']);

        $stmt = $conn->prepare(
            "SELECT user_id, username, first_name, last_name, middle_initial, contact_num, 
                    region, province, city, email, role, is_verified 
             FROM users WHERE user_id = ?"
        );
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            http_response_code(404);
            echo json_encode(["success" => false, "message" => "User not found"]);
            exit;
        }

        $user = $result->fetch_assoc();
        $stmt->close();
        http_response_code(200);
        echo json_encode($user);
        exit;
    }

    // Get all users with filtering
    $query = "SELECT user_id, username, first_name, last_name, email, contact_num, role, password,is_verified FROM users";
    $conditions = [];
    $params = [];
    $types = "";

    if (isset($_GET['role'])) {
        $conditions[] = "role = ?";
        $params[] = $_GET['role'];
        $types .= "s";
    }

    if (isset($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $conditions[] = "(username LIKE ? OR email LIKE ? OR first_name LIKE ? OR last_name LIKE ?)";
        $params[] = $search; $params[] = $search; $params[] = $search; $params[] = $search;
        $types .= "ssss";
    }

    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    if (count($params) > 0) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($query);
    }

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    http_response_code(200);
    echo json_encode($users);
    exit;
}

// Handle POST requests (create user)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["username"]) || !isset($data["email"]) || !isset($data["password"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Username, email, and password are required"]);
        exit;
    }

    $username = trim($data["username"]);
    $email = trim($data["email"]);
    $password = $data["password"];
    $first_name = $data["first_name"] ?? null;
    $last_name = $data["last_name"] ?? null;

    if (empty($username) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        exit;
    }

    // Check if username already exists
    $check_username = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $check_username->bind_param("s", $username);
    $check_username->execute();
    if ($check_username->get_result()->num_rows > 0) {
        http_response_code(409);
        echo json_encode(["success" => false, "message" => "Username already taken"]);
        exit;
    }

    // Check if email already exists
    $check_email = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    if ($check_email->get_result()->num_rows > 0) {
        http_response_code(409);
        echo json_encode(["success" => false, "message" => "Email already registered"]);
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, first_name, last_name, role) VALUES (?, ?, ?, ?, ?, 'user')");
    $stmt->bind_param("sssss", $username, $email, $password_hash, $first_name, $last_name);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode([
            "success" => true,
            "user_id" => $stmt->insert_id,
            "username" => $username,
            "message" => "User registered successfully"
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Registration failed"]);
    }
    exit;
}

// Method not allowed
http_response_code(405);
echo json_encode(["success" => false, "message" => "Method not allowed"]);