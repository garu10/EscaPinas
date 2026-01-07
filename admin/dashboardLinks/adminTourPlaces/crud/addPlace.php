<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = $_POST['tour_id'];
    $place_name = mysqli_real_escape_string($conn, $_POST['place_name']);
    $day_number = $_POST['day_number'];
    
    // Image Upload Logic
    $image = $_FILES['place_image']['name'];
    $target = "../../../../assets/images/tour_places/" . basename($image);

    if (move_uploaded_file($_FILES['place_image']['tmp_name'], $target)) {
        $sql = "INSERT INTO tour_place (tour_id, place_name, day_number, image) 
                VALUES ('$tour_id', '$place_name', '$day_number', '$image')";
        
        if (executeQuery($sql)) {
            header("Location: ../../../adminDashboard.php?page=adminTourPlaces&status=success");
        }
    }
}
?>