<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Optional: Delete physical file logic here
    
    $sql = "DELETE FROM tour_place WHERE place_id = $id";
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourPlaces&status=deleted");
    }
}
?>