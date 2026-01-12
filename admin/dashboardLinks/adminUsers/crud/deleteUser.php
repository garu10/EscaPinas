<?php
// $path = "../../../../frontend/php/connect.php";
// if (!file_exists($path)) {
//     die("Error: connect.php not found at " . realpath($path));
// }
// include_once($path);

// if (isset($_GET['id'])) {
//     $user_id = (int)$_GET['id'];
    
//     // Safety Check: Avoid deleting yourself if you are logged in
//     session_start();
//     if ($user_id == $_SESSION['user_id']) {
//         header("Location: ../../../adminDashboard.php?page=adminUsers&error=selfdelete");
//         exit();
//     }

//     $sql = "DELETE FROM users WHERE user_id = $user_id";

//     if (mysqli_query($conn, $sql)) {
//         header("Location: ../../../adminDashboard.php?page=adminUsers&status=deleted");
//     } else {
//         echo "Error: Could not delete user.";
//     }
// }
?>