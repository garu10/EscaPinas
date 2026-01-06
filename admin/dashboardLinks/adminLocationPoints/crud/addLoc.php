<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $island = mysqli_real_escape_string($conn, $_POST['origin_island']);
    $pickup = mysqli_real_escape_string($conn, $_POST['pickup_points']);
    $dropoff = mysqli_real_escape_string($conn, $_POST['dropoff_points']);

    $sql = "INSERT INTO location_points (origin_island, pickup_points, dropoff_points) VALUES ('$island', '$pickup', '$dropoff')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminLocationPoints&status=success");
    }
}
?>