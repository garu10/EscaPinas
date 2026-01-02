<?php
session_start();
include_once "../php/connect.php"; 

header('Content-Type: application/json');

$orderID = $_POST['orderID'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer $token"]);
$res = json_decode(curl_exec($ch));
curl_close($ch);

if (isset($res->status) && $res->status === 'COMPLETED') {
    $uid = $_SESSION['user_id'] ?? 1;
    $tid = intval($_POST['tour_id']);
    $loc = mysqli_real_escape_string($conn, $_POST['loc_name']);
    $addr = mysqli_real_escape_string($conn, $_POST['loc_addr']);

    $sql = "INSERT INTO bookings (user_id, tour_id, pickup_location, pickup_address, payment_status) 
            VALUES ($uid, $tid, '$loc', '$addr', 'Paid')";
    
    if (executeQuery($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB Error']);
    }
}