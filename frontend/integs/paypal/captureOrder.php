<?php
session_start();
include_once "../../php/connect.php";

/* make the json only response */
ob_start();
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

/* session validation*/
if (!isset($_SESSION['user_id'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Session expired. Please login again.'
    ]);
    exit;
}

$user_id = intval($_SESSION['user_id']);

/* credentials */
$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";

/* get the access token */
$ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => "$clientId:$secret",
    CURLOPT_POSTFIELDS => "grant_type=client_credentials"
]);
$tokenResult = json_decode(curl_exec($ch), true);
curl_close($ch);

if (empty($tokenResult['access_token'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'PayPal authentication failed.'
    ]);
    exit;
}

$token = $tokenResult['access_token'];

/* capture the paypal order*/
$orderID = $_POST['orderID'] ?? '';

if (!$orderID) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Missing PayPal Order ID.'
    ]);
    exit;
}

$ch = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID/capture");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ]
]);
$response = json_decode(curl_exec($ch), true);
curl_close($ch);

/* validation of paypal response */
if (
    empty($response['status']) ||
    $response['status'] !== 'COMPLETED' ||
    empty($response['purchase_units'][0]['payments']['captures'][0]['id'])
) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Payment not completed.'
    ]);
    exit;
}

$paypal_capture_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];

/* validation of inputs */
$tour_id      = intval($_POST['tour_id'] ?? 0);
$schedule_id  = intval($_POST['schedule_id'] ?? 0);
$locpoints_id = intval($_POST['locpoints_id'] ?? 0);
$pax          = max(1, intval($_POST['pax'] ?? 1));
$total        = floatval($_POST['total_amount'] ?? 0);

if ($tour_id <= 0 || $schedule_id <= 0 || $locpoints_id <= 0 || $total <= 0) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Invalid booking data.'
    ]);
    exit;
}

/* database injection */
$booking_ref = "ESC-" . date("Y") . "-" . strtoupper(substr(uniqid(), -6));

mysqli_begin_transaction($conn);

try {

    $sql_booking = "
        INSERT INTO bookings
        (user_id, tour_id, schedule_id, locpoints_id, number_of_persons, total_amount, booking_status, booking_reference, is_email_sent)
        VALUES
        ($user_id, $tour_id, $schedule_id, $locpoints_id, $pax, $total, 'Confirmed', '$booking_ref', 1)
    ";

    if (!mysqli_query($conn, $sql_booking)) {
        throw new Exception(mysqli_error($conn));
    }

    $booking_id = mysqli_insert_id($conn);

    $sql_payment = "
        INSERT INTO payments
        (booking_id, user_id, paypal_order_id, paypal_capture_id, amount, payment_status)
        VALUES
        ($booking_id, $user_id, '$orderID', '$paypal_capture_id', $total, 'COMPLETED')
    ";

    if (!mysqli_query($conn, $sql_payment)) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_commit($conn);

    /*email sending at the same time upon confirmation of payment*/
    $email_file = __DIR__ . '/../email/sendEmail.php';
    if (file_exists($email_file)) {
        include_once $email_file;
        if (function_exists('sendBookingEmail')) {
            try {
                sendBookingEmail($conn, $booking_id, $booking_ref);
            } catch (Exception $e) {
                error_log("Email error: " . $e->getMessage());
            }
        }
    }

    ob_clean();
    echo json_encode([
        'success' => true,
        'ref' => $booking_ref
    ]);
    exit;
} catch (Exception $e) {

    mysqli_rollback($conn);
    error_log("Booking Error: " . $e->getMessage());

    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Booking failed. Please try again.'
    ]);
    exit;
}
