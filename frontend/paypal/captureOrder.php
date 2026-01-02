<?php
require_once "php/connect.php";

$clientId = "AR_ityCiAr_1l5CInno8S9b7EVE0xZMxuGTaky01nSU3vZUi4DH2UuKmQyCkVs-SDiDondbdcl8VZM4I";
$secret   = "key;

function generateAccessToken($clientId, $secret)
{
    $ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ["Accept: application/json"],
        CURLOPT_USERPWD => "$clientId:$secret",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true
    ]);
    $response = curl_exec($ch);
    return json_decode($response, true)["access_token"];
}

$orderId = $_POST['orderID'];
$token   = generateAccessToken($clientId, $secret);

// 1. Capture Payment
$ch = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderId/capture");
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ],
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true
]);

$response = json_decode(curl_exec($ch), true);

/* ===== VERIFY AND INSERT INTO DB ===== */
if (isset($response['status']) && $response['status'] === "COMPLETED") {

    // 2. Prepare Data for Insertion
    $tour_id      = (int) $_POST['tour_id'];
    $pax          = (int) $_POST['pax'];
    $loc_name     = mysqli_real_escape_string($conn, $_POST['loc_name']);
    $loc_addr     = mysqli_real_escape_string($conn, $_POST['loc_addr']);

    // Get amount captured
    $paid_amount  = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

    // Generate Reference ID
    $booking_ref  = "BK-" . strtoupper(uniqid());

    // Default User ID (You should replace this with $_SESSION['user_id'] if logged in)
    $user_id      = 1;

    // Default Schedule ID (Ideally this comes from the form input)
    $schedule_id  = 1;

    // 3. Insert into 'bookings' table
    $insertBooking = "INSERT INTO bookings 
                     (user_id, schedule_id, number_of_persons, total_amount, booking_status, booking_reference) 
                     VALUES 
                     ($user_id, $schedule_id, $pax, '$paid_amount', 'Confirmed', '$booking_ref')";

    if (executeQuery($insertBooking)) {
        $booking_id = $conn->insert_id;

        // 4. Insert into 'pickup_dropoff' table
        $insertPickup = "INSERT INTO pickup_dropoff 
                        (tour_id, booking_id, location_name, location_address) 
                        VALUES 
                        ($tour_id, $booking_id, '$loc_name', '$loc_addr')";

        executeQuery($insertPickup);

        echo json_encode(["success" => true, "ref" => $booking_ref]);
    } else {
        echo json_encode(["success" => false, "message" => "Database Insert Failed"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Payment not completed"]);
}
