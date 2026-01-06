<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['locpoints_id'];
    $island = mysqli_real_escape_string($conn, $_POST['origin_island']);
    $pickup = mysqli_real_escape_string($conn, $_POST['pickup_points']);
    $dropoff = mysqli_real_escape_string($conn, $_POST['dropoff_points']);

    $sql = "UPDATE location_points SET 
            origin_island = '$island', 
            pickup_points = '$pickup', 
            dropoff_points = '$dropoff' 
            WHERE locpoints_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminLocationPoints&status=updated");
    }
}
?>