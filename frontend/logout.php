<?php
session_start();

/* reset all session variables */
$_SESSION = [];

/* Destroy the session */
session_destroy();

/*delete the cookies therefore even if the user back the page it is still log out*/
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
// after log out redirect to login page
header("Location: login.php");
exit;
