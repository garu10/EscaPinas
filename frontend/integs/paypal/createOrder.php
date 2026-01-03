<?php
session_start();
// binago ko yung path gawa nilipat ko sa integs na folder yung paypal
include_once "../../php/connect.php"; 

header('Content-Type: application/json');

$clientId = "AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z";
$secret   = "EMwRDIR7WXs5yZ2-iRGvfe1U5ltmmlRhWk5YhTaRqlv4Et-ragrwo7YEMRkblCuz4fGitoV47iUp23Su";
$baseUrl = "https://api-m.sandbox.paypal.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$baseUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$auth = json_decode(curl_exec($ch));
$token = $auth->access_token;

$tour_id = intval($_POST['tour_id']);
$pax = intval($_POST['pax']);
$res = executeQuery("SELECT price FROM tour_packages WHERE tour_id = $tour_id");
$tour = $res->fetch_assoc();
$total_amount = ($tour['price'] * $pax) * 1.12; 

$orderData = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => ["currency_code" => "PHP", "value" => number_format($total_amount, 2, '.', '')]
    ]]
];

curl_setopt($ch, CURLOPT_URL, "$baseUrl/v2/checkout/orders");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer $token"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
$response = curl_exec($ch);
curl_close($ch);

echo $response;