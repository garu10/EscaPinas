<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE booking_id = $id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminBookings&status=deleted");
    } else {
        echo "Error deleting record.";
    }
}
?>