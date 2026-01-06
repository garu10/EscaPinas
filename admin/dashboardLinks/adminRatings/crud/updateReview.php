<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['review_id'];
    $score = $_POST['rating_score'];
    $text = mysqli_real_escape_string($conn, $_POST['review_text']);

    $sql = "UPDATE ratings SET rating_score = '$score', review_text = '$text' WHERE review_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRatings&status=updated");
    }
}
?>