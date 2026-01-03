<?php
session_start();
// binago ko yung path gawa nilipat ko sa integs na folder yung paypal
include_once "../../php/connect.php";

header('Content-Type: application/json');
ob_clean();

/* =========================
   1. PAYPAL ACCESS TOKEN
========================= */
$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);
$tokenResult = json_decode(curl_exec($ch), true);
curl_close($ch);

if (!isset($tokenResult['access_token'])) {
    echo json_encode(['success' => false, 'message' => 'PayPal auth failed']);
    exit;
}
$token = $tokenResult['access_token'];

/* =========================
   2. CAPTURE ORDER
========================= */
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
    echo json_encode(['success' => false, 'message' => 'Payment not completed']);
    exit;
}

/* =========================
   3. SAVE BOOKING
========================= */
$user_id    = $_SESSION['user_id'] ?? 1;
$schedule   = intval($_POST['schedule_id']);
$pax        = intval($_POST['pax']);
$total      = floatval($_POST['total_amount']);

$booking_ref = "ESC-" . date("Y") . "-" . strtoupper(uniqid());

$sql = "
INSERT INTO bookings 
(user_id, schedule_id, number_of_persons, total_amount, booking_status, booking_reference)
VALUES
($user_id, $schedule, $pax, $total, 'Confirmed', '$booking_ref')
";

if (executeQuery($sql)) {
    echo json_encode([
        'success' => true,
        'ref' => $booking_ref
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database insert failed'
    ]);
}
exit;
