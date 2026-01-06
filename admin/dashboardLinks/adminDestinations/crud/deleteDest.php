<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM destinations WHERE destination_id = $id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminDestinations&status=deleted");
    }
}
?>