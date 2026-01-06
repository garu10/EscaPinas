<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $wish_id = intval($_GET['id']);
    
    $sql = "DELETE FROM wishlist WHERE wishlist_id = $wish_id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminWishlists&status=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../../../adminDashboard.php?page=adminWishlists");
    exit();
}
?>