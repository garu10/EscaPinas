<?php
session_start();
include_once "../../php/connect.php";

// 1. Gumamit ng Output Buffering para pigilan ang mga accidental echoes/warnings
ob_start(); 
header('Content-Type: application/json');

$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";

// AUTH TOKEN
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$tokenResult = json_decode(curl_exec($ch), true);
curl_close($ch);

if (!isset($tokenResult['access_token'])) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'PayPal auth failed']);
    exit;
}
$token = $tokenResult['access_token'];

// CAPTURE ORDER
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
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Payment failed or not captured']);
    exit;
}

// DATA PREPARATION
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
    // 2. Siguraduhin na ang $conn ay available at walang 'echo' sa loob ng executeQuery
    $sql_booking = "INSERT INTO bookings 
            (user_id, tour_id, schedule_id, locpoints_id, number_of_persons, total_amount, booking_status, booking_reference, is_email_sent)
            VALUES
            ($user_id, $tour_id, $schedule_id, $locpoints_id, $pax, $total, 'Confirmed', '$booking_ref', 1)";

    if (!mysqli_query($conn, $sql_booking)) {
        throw new Exception("Error saving booking: " . mysqli_error($conn));
    }

    $new_booking_id = mysqli_insert_id($conn);

    $sql_payment = "INSERT INTO payments 
            (booking_id, user_id, paypal_order_id, paypal_capture_id, amount, payment_status)
            VALUES 
            ($new_booking_id, $user_id, '$paypal_order_id', '$paypal_capture_id', $total, 'COMPLETED')";

    if (!mysqli_query($conn, $sql_payment)) {
        throw new Exception("Error saving payment record: " . mysqli_error($conn));
    }

    mysqli_commit($conn);

    // 3. SILENT EMAIL SENDING
    $email_file = __DIR__ . '/../email/sendEmail.php';
    if (file_exists($email_file)) {
        include_once $email_file; 
        try {
            // Siguraduhin na ang function na ito ay walang 'echo' or 'print'
            sendBookingEmail($conn, $new_booking_id, $booking_ref);
        } catch (Exception $e) {
            error_log("Email error: " . $e->getMessage());
        }
    }

    // 4. LINISIN ANG BUFFER bago mag-output ng JSON
    ob_clean();
    echo json_encode([
        'success' => true,
        'ref' => $booking_ref
    ]);
    exit;

} catch (Exception $e) {
    mysqli_rollback($conn);
    error_log($e->getMessage());
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit;
}