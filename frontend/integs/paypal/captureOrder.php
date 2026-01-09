<?php
session_start();

$connect_path = __DIR__ . "/../../php/connect.php";
if (!file_exists($connect_path)) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Path error: connect.php not found.']);
    exit;
}
include_once $connect_path;

ob_start();
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Session expired.']);
    exit;
}

$user_id = intval($_SESSION['user_id']);

// PayPal Credentials
$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";

$ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_USERPWD => "$clientId:$secret",
    CURLOPT_POSTFIELDS => "grant_type=client_credentials"
]);
$tokenResult = json_decode(curl_exec($ch), true);
curl_close($ch);

if (empty($tokenResult['access_token'])) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'PayPal auth failed']);
    exit;
}

$token = $tokenResult['access_token'];

$orderID = $_POST['orderID'] ?? '';
$ch = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID/capture");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Authorization: Bearer $token"]
]);
$response = json_decode(curl_exec($ch), true);
curl_close($ch);

if (empty($response['status']) || $response['status'] !== 'COMPLETED') {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Payment failed at PayPal.']);
    exit;
}

$paypal_capture_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];

$tour_id      = intval($_POST['tour_id'] ?? 0);
$schedule_id  = intval($_POST['schedule_id'] ?? 0);
$locpoints_id = intval($_POST['locpoints_id'] ?? 0);
$pax           = intval($_POST['pax'] ?? 1);
$total        = floatval($_POST['total_amount'] ?? 0);
$voucher_code = mysqli_real_escape_string($conn, $_POST['voucher_code'] ?? '');
$booking_ref  = "ESC-" . date("Y") . "-" . strtoupper(substr(uniqid(), -6));

mysqli_begin_transaction($conn);

try {
    // dinagdag ni ralph sa captureOrder -- query para maupdate yung slots ng schedule
    $pax = intval($_POST['pax']);
    $schedule_id = intval($_POST['schedule_id']);
    
    $updateSlots = $conn->prepare("UPDATE tour_schedules SET available_slots = available_slots - ? WHERE schedule_id = ? AND available_slots >= ?");
    $updateSlots->bind_param("iii", $pax, $schedule_id, $pax);
    $updateSlots->execute();

    if ($updateSlots->affected_rows === 0) {
        throw new Exception("Not enough slots available for this schedule.");
    }

    $conn->commit();
    echo json_encode(['success' => true, 'ref' => $booking_ref]);
    // dinagdag ni ralph sa captureOrder -- query para maupdate yung slots ng schedule
    
    // insert the booking
    $sql_booking = "INSERT INTO bookings (user_id, tour_id, schedule_id, locpoints_id, number_of_persons, total_amount, booking_status, booking_reference)
                    VALUES ($user_id, $tour_id, $schedule_id, $locpoints_id, $pax, $total, 'Confirmed', '$booking_ref')";
    if (!mysqli_query($conn, $sql_booking)) throw new Exception("Booking insertion failed");

    $booking_id = mysqli_insert_id($conn);

    // insert the payment
    $sql_payment = "INSERT INTO payments (booking_id, user_id, paypal_order_id, paypal_capture_id, amount, payment_status)
                    VALUES ($booking_id, $user_id, '$orderID', '$paypal_capture_id', $total, 'COMPLETED')";
    if (!mysqli_query($conn, $sql_payment)) throw new Exception("Payment insertion failed");

    // update voucher as redeemed if a voucher code was used
    if (!empty($voucher_code)) {
        $temp_query = "SELECT template_id FROM voucher_templates WHERE code = '$voucher_code' LIMIT 1";
        $temp_res = mysqli_query($conn, $temp_query);
        $temp_data = mysqli_fetch_assoc($temp_res);

        if ($temp_data) {
            $tid = $temp_data['template_id'];

            // record the voucher redemption and change its status
            $sql_voucher = "UPDATE user_vouchers 
                            SET is_redeemed = 1, 
                                redeemed_at = NOW() 
                            WHERE template_id = $tid AND user_id = $user_id";

            if (!mysqli_query($conn, $sql_voucher)) throw new Exception("Voucher redemption failed");
        }
    }

    mysqli_commit($conn);
    ob_clean();
    echo json_encode(['success' => true, 'ref' => $booking_ref]);
    exit;
} catch (Exception $e) {
    mysqli_rollback($conn);
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit;
}
