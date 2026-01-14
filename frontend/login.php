<?php
session_start();
include 'php/connect.php';
include 'integs/api/api-connect/api-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Login is now handled via API
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Use the API endpoint for login']);
    exit;
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

                            <form id="loginForm">
                                <div class="mb-3">
                                    <input type="text" name="email" class="form-control" placeholder="Username or Email" required>
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
    <script src="assets/js/login.js"></script>
</body>

</html>