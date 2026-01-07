<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['place_id']);
    $tour_id = intval($_POST['tour_id']);
    $place_name = mysqli_real_escape_string($conn, $_POST['place_name']);
    $day_number = intval($_POST['day_number']);
    $old_image = $_POST['old_image'];

    $image_name = $old_image; // Default to existing

    // Check if a new image was uploaded
    if (isset($_FILES['place_image']['name']) && $_FILES['place_image']['name'] != "") {
        $image_name = $_FILES['place_image']['name'];
        $target = "../../../../assets/images/tour_places/" . basename($image_name);
        
        move_uploaded_file($_FILES['place_image']['tmp_name'], $target);
    }

    $sql = "UPDATE tour_place SET 
            tour_id = $tour_id, 
            place_name = '$place_name', 
            day_number = $day_number, 
            image = '$image_name' 
            WHERE place_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourPlaces&status=updated");
    }
}
?>