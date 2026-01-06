<?php
session_start();
include_once "../../php/connect.php";

header('Content-Type: application/json');

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

$paypal_order_id   = $orderID;
$paypal_capture_id = $response['purchase_units'][0]['payments']['captures'][0]['id'] ?? '';

$booking_ref = "ESC-" . date("Y") . "-" . strtoupper(substr(uniqid(), -6));

mysqli_begin_transaction($conn);

try {
    $sql_booking = "INSERT INTO bookings 
            (user_id, tour_id, schedule_id, locpoints_id, number_of_persons, total_amount, booking_status, booking_reference, is_email_sent)
            VALUES
            ($user_id, $tour_id, $schedule_id, $locpoints_id, $pax, $total, 'Confirmed', '$booking_ref', 1)";

    if (!executeQuery($sql_booking)) {
        throw new Exception("Error saving booking: " . mysqli_error($conn));
    }

    $new_booking_id = mysqli_insert_id($conn);

    $sql_payment = "INSERT INTO payments 
            (booking_id, user_id, paypal_order_id, paypal_capture_id, amount, payment_status)
            VALUES 
            ($new_booking_id, $user_id, '$paypal_order_id', '$paypal_capture_id', $total, 'COMPLETED')";

    if (!executeQuery($sql_payment)) {
        throw new Exception("Error saving payment record: " . mysqli_error($conn));
    }

    mysqli_commit($conn);
    mysqli_commit($conn);

    $email_file = __DIR__ . '/../email/sendEmail.php';

    if (file_exists($email_file)) {
        require_once $email_file;
        // Call it with a try-catch so if email fails, the JSON still sends
        try {
            sendBookingEmail($conn, $new_booking_id, $booking_ref);
        } catch (Exception $e) {
            error_log("Email error: " . $e->getMessage());
        }
    }

    echo json_encode([
        'success' => true,
        'ref' => $booking_ref
    ]);
    exit;
} catch (Exception $e) {
    mysqli_rollback($conn);

    error_log($e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage() . '. Payment ID: ' . $paypal_capture_id
    ]);
}
