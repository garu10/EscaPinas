<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM tour_about WHERE about_id = $id";
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourAbout&status=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../../../adminDashboard.php?page=adminTourAbout");
    exit();
}
?>