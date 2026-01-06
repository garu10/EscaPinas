<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origin = $_POST['origin_island'];
    $destination = $_POST['destination_island'];
    $fee = $_POST['additional_fee'];

    $sql = "INSERT INTO region_fees (origin_island, destination_island, additional_fee) 
            VALUES ('$origin', '$destination', '$fee')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRegionFees&status=success");
    }
}
?>