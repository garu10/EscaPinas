<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['booking_id'];
    $status = $_POST['booking_status'];

    $sql = "UPDATE bookings SET booking_status = '$status' WHERE booking_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminBookings&status=updated");
    } else {
        echo "Error updating record.";
    }
}
?>