<?php
session_start();
include_once "../php/connect.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$region = isset($_POST['region']) ? trim($_POST['region']) : '';

if (empty($region)) {
    echo json_encode(['success' => false, 'message' => 'Region is required', 'locations' => []]);
    exit;
}

$query = "SELECT locpoints_id, pickup_points FROM location_points WHERE origin_island = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $region);
$stmt->execute();
$result = $stmt->get_result();

$locations = [];
while ($row = $result->fetch_assoc()) {
    $locations[] = $row;
}

echo json_encode([
    'success' => true,
    'locations' => $locations
]);
?>
