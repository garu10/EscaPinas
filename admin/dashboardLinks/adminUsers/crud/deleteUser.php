<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    // Safety Check: Avoid deleting yourself if you are logged in
    session_start();
    if ($user_id == $_SESSION['user_id']) {
        header("Location: ../../../adminDashboard.php?page=adminUsers&error=selfdelete");
        exit();
    }

    $sql = "DELETE FROM users WHERE user_id = $user_id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminUsers&status=deleted");
    } else {
        echo "Error: Could not delete user.";
    }
}
?>