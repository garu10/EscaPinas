<?php
session_start();
include_once "../../php/connect.php";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'] ?? null;
    $tour_id = $_POST['tour_id'] ?? null;
    $rating_score = $_POST['rating_score'] ?? null;
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text'] ?? '');

    if ($user_id && $tour_id && $rating_score) {
        
        $sql = "INSERT INTO ratings (user_id, tour_id, review_text, rating_score) 
                VALUES ('$user_id', '$tour_id', '$review_text', '$rating_score')";

        if (executeQuery( $sql)) {
            header("Location: ../../profile.php?page=reviews&status=success");
            exit();
        } else {
            die("SQL Error: " . mysqli_error($conn));
        }
    } else {
        die("Error: Missing required fields or user not logged in.");
    }
}
?>