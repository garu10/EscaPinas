<?php
include 'php/connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $get_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = executeQuery($get_email);

    /*if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    echo "<h3>Debugging Password Issue</h3>";
    echo "1. Plain Text Entered: " . $password . "<br>";
    echo "2. Hash stored in DB: " . $user['password'] . "<br>";
    echo "3. Length of Hash in DB: " . strlen($user['password']) . " characters<br>";
    
    if (password_verify($password, $user['password'])) {
        echo "<b style='color:green'>4. Result: VERIFY SUCCESS!</b>";
    } else {
        echo "<b style='color:red'>4. Result: VERIFY FAILED!</b>";
        
        // Let's test if the hash in DB is even a valid hash
        $info = password_get_info($user['password']);
        echo "<br>5. Is this a valid hash? " . ($info['algo'] != 0 ? 'Yes' : 'No');
    }
    exit(); // Stop the page here so we can read this
}*/

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // verification of password 
        if (password_verify($password, $user['password'])) {
            // store session data 
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['role'] = $user['role'];

            // if mag lagay tayo ng admin (pede areh baguhin)
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else { //baguhin eto gagawa sarili natin modal
            echo "<script>alert('Invalid Password!'); window.location='login.php';</script>";
        }
    } else { //baguhin eto gagawa sarili natin modal
        echo "<script>alert('No account found with that email!'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card glass-card mx-auto">
                    <div class="row">
                        <div class="col-md-6 welcome-section">
                            <div class="logo-area">
                                <img src="assets/images/logo2.jpg" alt="EscaPinas Logo" class="logo-img">
                                <div class="brand-name">EscaPinas</div>
                                <div class="small">Travel Agency • Philippines
                                </div>
                            </div>
                            <div class="welcome-text">
                                <div class="h2">Mabuhay!<br>Welcome Back, Explorer!</div>
                                <div class="lead">Which Philippine destination arse we bringing to life today?</div>
                            </div>
                        </div>
                        <div class="col-md-6 login-section">
                            <div class="login-header h2 text-center">Login</div>
                            <form method="POST">
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>

                                <a href="#" class="forgot-pass">Forgot Password?</a>

                                <button type="submit" class="btn btn-primary btn-login">Login</button>
                                <div class="register-link">
                                    Don't have an Account? <a href="registerAccount.php">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>