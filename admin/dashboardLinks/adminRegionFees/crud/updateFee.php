<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['fee_id'];
    $origin = $_POST['origin_island'];
    $destination = $_POST['destination_island'];
    $fee = $_POST['additional_fee'];

    $sql = "UPDATE region_fees SET 
            origin_island = '$origin', 
            destination_island = '$destination', 
            additional_fee = '$fee' 
            WHERE fee_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRegionFees&status=updated");
    }
}
?>