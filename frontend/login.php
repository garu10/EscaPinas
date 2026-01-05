<?php
session_start();
include 'php/connect.php';

// Function para sa Resend SMS
function sendSMS($to, $msg) {
    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = [
        "phoneNumbers" => [$to],
        "textMessage" => ["text" => $msg]
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);
}

$error_msg = ""; 
$show_resend = false;
$resend_email = "";

// LOGIC PARA SA RESEND
if (isset($_GET['resend'])) {
    $email_to_resend = mysqli_real_escape_string($conn, $_GET['resend']);
    $query = "SELECT contact_num FROM users WHERE email = '$email_to_resend' AND is_verified = 0 LIMIT 1";
    $res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($res)) {
        $msg = "EscaPinas: Para ma-verify ang account, mag-reply lamang ng YES.";
        sendSMS($row['contact_num'], $msg);
        echo "<script>alert('Verification SMS resent!'); window.location.href='login.php';</script>";
        exit();
    }
}

// LOGIC PARA SA LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Gamit ang mysqli_query para sa compatibility
    $get_user = "SELECT * FROM users WHERE email = '$email' LIMIT 1";  
    $result = mysqli_query($conn, $get_user);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 0) {
                // ITO ANG ERROR MESSAGE NA HININGI MO
                $error_msg = "Account not verified. Please reply 'YES' to our SMS.";
                $show_resend = true; 
                $resend_email = $user['email'];
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            }
        } else {
            $error_msg = "Invalid Password!";
        }
    } else {
        $error_msg = "No account found with that email!";
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
    <link rel="stylesheet" href="assets/css/login.css"> </head>
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
                                <div class="small">Travel Agency • Philippines</div>
                            </div>
                            <div class="welcome-text">
                                <div class="h2">Mabuhay!<br>Welcome Back, Explorer!</div>
                                <div class="lead">Which Philippine destination are we bringing to life today?</div>
                            </div>
                        </div>

                        <div class="col-md-6 login-section">
                            <div class="login-header h2 text-center">Login</div>

                            <?php if (!empty($error_msg)): ?>
                                <div class="alert alert-danger py-2 text-center mb-3" style="font-size: 0.85rem; border-radius: 10px; background: rgba(255, 0, 0, 0.2); border: 1px solid red; color: white;">
                                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error_msg; ?>
                                    <?php if ($show_resend): ?>
                                        <br><a href="login.php?resend=<?php echo urlencode($resend_email); ?>" style="color: #ffeb3b; font-weight: bold; text-decoration: underline;">Resend Verification SMS</a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>