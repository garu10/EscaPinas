<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM location_points WHERE locpoints_id = $id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminLocationPoints&status=deleted");
    }
}
?>