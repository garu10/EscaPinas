<?php
require_once "php/connect.php";

function generateAccessToken()
{
    $client = "AR_ityCiAr_1l5CInno8S9b7EVE0xZMxuGTaky01nSU3vZUi4DH2UuKmQyCkVs-SDiDondbdcl8VZM4I";
    $secret = "EJtqCdoK7GXAlZi7RQAtEugsKQkD7ZmHCs7kJ23lGhed5mAfz9HdfU1CoaphjYrUAj1RyE-igi209atk";

    $ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ["Accept: application/json"],
        CURLOPT_USERPWD => "$client:$secret",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($ch);
    return json_decode($response, true)["access_token"];
}

$orderId = $_POST['orderID'];
$token   = generateAccessToken();

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

/* ===== VERIFY PAYMENT ===== */
if ($response['status'] === "COMPLETED") {
    // TODO: INSERT booking + payment here
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
