<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM ratings WHERE review_id = $id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRatings&status=deleted");
    }
}
?>