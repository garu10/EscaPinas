<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = intval($_POST['tour_id']);
    $day_number = intval($_POST['day_number']);
    $desc = mysqli_real_escape_string($conn, $_POST['short_desc']);

    $sql = "INSERT INTO tour_itinerary (tour_id, day_number, short_desc) VALUES ($tour_id, $day_number, '$desc')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourItinerary&status=created");
    }
}
?>