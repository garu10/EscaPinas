<?php
include 'php/connect.php'; 

$showVerificationModal = false;
$registeredEmail = ""; 

function sendSMS($to, $msg) {
    $to = preg_replace('/[^0-9+]/', '', $to);

    if(substr($to, 0, 1) == "0") {
        $to = "+63" . substr($to, 1);
    }

    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    
    $payload = [
        "phoneNumbers" => [$to],
        "textMessage" => [
            "text" => $msg
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    if ($password !== $confirm_password) {
        echo "<script>alert('Error: Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkEmail = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $checkEmail);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        </script>";
    } else {
        $insertUser = "INSERT INTO users (first_name, last_name, middle_initial, contact_num, province, city, email, password, role, is_verified) 
                       VALUES ('$fname', '$last_name', '$middle_initial', '$contact_num', '$province', '$city', '$email', '$hashed_password', '$role', 0)";

        if (mysqli_query($conn, $insertUser)) {
            $showVerificationModal = true;
            $registeredEmail = $email; 

$initial_msg = "EscaPinas: Salamat sa pag-register! Para ma-verify ang account, mag-reply lamang ng: YES";
sendSMS($contact_num, $initial_msg);   
     } else {
            echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
    <div class="container w-100">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card glass-card mx-auto my-4">
                    <div class="row g-0">
                        <div class="col-md-5 welcome-section p-5">
                            <div class="logo-area">
                                <img src="assets/images/logo2.jpg" alt="EscaPinas Logo" class="logo-img">
                                <div class="brand-name">EscaPinas</div>
                                <div class="small">Travel Agency • Philippines</div>
                            </div>
                            <div class="welcome-text text-start mt-4">
                                <div class="h2 text-start">Magandang Araw!<br>Join Us Today!</div>
                                <div class="lead">Register to manage Philippine tour packages with ease.</div>
                            </div>
                        </div>

                        <div class="col-md-7 login-section p-5">
                            <div class="login-header h2 text-center mb-4">Create an Account</div>
                            <form method="POST">
                                <div class="row g-2 mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="M.I." name="middle_initial" maxlength="1">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Contact Number (e.g., 0917...)" name="contact_num" required>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Province" name="province">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="City" name="city">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label small text-white" for="terms">
                                        I agree to the <a href="#" class="text-white fw-bold">Terms & Conditions</a>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-login w-100">Register</button>

                                <div class="register-link mt-3 text-center">
                                    Already have an Account? <a href="login.php">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white border-0">
                    <div class="modal-title">
                        <i class="h5 fas fa-check-circle me-2"></i> Registration Successful
                    </div>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-check text-success" style="font-size: 3rem;"></i>
                    </div>
                    <div class="h4 fw-bold">Welcome to EscaPinas!</div>
                    <p class="text-muted">Kailangan mo munang i-verify ang iyong account via SMS:</p>
                    
                    <div class="bg-light p-3 border rounded mb-3">
                        <span class="small text-muted d-block">I-TEXT ANG:</span>
                        <strong class="h5">VERIFY <?php echo $registeredEmail; ?></strong>
                        <hr class="my-2">
                        <span class="small text-muted d-block">I-SEND SA:</span>
                        <strong class="h5 text-primary">09XXXXXXXXX</strong> </div>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-success px-5 rounded-pill" id="btnRedirect">
                        Go to Login
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white border-0">
                    <div class="modal-title">
                        <i class="h5 fas fa-exclamation-triangle me-2"></i> Registration Error
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-envelope-open-text text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <div class="h4 fw-bold">Email Already Exists!</div>
                    <div class="text-muted">The email address you entered is already associated with an account.</div>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('btnRedirect').addEventListener('click', function() {
            window.location.href = 'login.php';
        });
    </script>
    <?php if ($showVerificationModal): ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
            backdrop: 'static',
            keyboard: false
        });
        myModal.show();
    </script>
    <?php endif; ?>
</body>
</html>