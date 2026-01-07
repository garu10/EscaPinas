<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['itinerary_id']);
    $tour_id = intval($_POST['tour_id']);
    $day_number = intval($_POST['day_number']);
    $desc = mysqli_real_escape_string($conn, $_POST['short_desc']);

    $sql = "UPDATE tour_itinerary SET tour_id = $tour_id, day_number = $day_number, short_desc = '$desc' WHERE itinerary_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourItinerary&status=updated");
    }
}
?>