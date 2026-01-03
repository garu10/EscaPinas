<?php
session_start();
include_once "../../php/connect.php";

header('Content-Type: application/json');

error_reporting(0); 

$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$tokenResult = json_decode(curl_exec($ch), true);
curl_close($ch);

if (!isset($tokenResult['access_token'])) {
    echo json_encode(['success' => false, 'message' => 'PayPal auth failed']);
    exit;
}
$token = $tokenResult['access_token'];

$orderID = $_POST['orderID'] ?? '';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $token"
]);
$response = json_decode(curl_exec($ch), true);
curl_close($ch);

if (!isset($response['status']) || $response['status'] !== 'COMPLETED') {
    echo json_encode(['success' => false, 'message' => 'Payment failed or not captured']);
    exit;
}

$user_id      = $_SESSION['user_id'] ?? 0; 
$tour_id      = intval($_POST['tour_id'] ?? 0);
$schedule_id  = intval($_POST['schedule_id'] ?? 0);
$locpoints_id = intval($_POST['locpoints_id'] ?? 0);
$pax          = intval($_POST['pax'] ?? 1);
$total        = floatval($_POST['total_amount'] ?? 0);
$paypal_id    = $response['purchase_units'][0]['payments']['captures'][0]['id'] ?? '';

$booking_ref = "ESC-" . date("Y") . "-" . strtoupper(substr(uniqid(), -6));

$sql = "INSERT INTO bookings 
        (user_id, tour_id, schedule_id, locpoints_id, number_of_persons, total_amount, booking_status, booking_reference)
        VALUES
        ($user_id, $tour_id, $schedule_id, $locpoints_id, $pax, $total, 'Confirmed', '$booking_ref')";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'success' => true,
        'ref' => $booking_ref
    ]);
} else {
    error_log("DB Error: " . mysqli_error($conn));
    echo json_encode([
        'success' => false,
        'message' => 'Database error, but payment was successful. Please contact support with ID: ' . $paypal_id
    ]);
}
?>