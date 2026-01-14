<?php
include("php/connect.php");
include("integs/api/api-connect/api-connect.php");

$showVerificationModal = isset($_GET['verify']) ? true : false;
$registeredEmail = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registration is now handled via API
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Use the API endpoint for registration']);
    exit;
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
                                <img src="assets/images/logo2.jpg" alt="Logo" class="logo-img">
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
                            <form id="registerForm">
                                <div class="row g-2 mb-3">
                                    <div class="col-md-5"><input type="text" class="form-control" placeholder="First Name" name="first_name" required></div>
                                    <div class="col-md-2"><input type="text" class="form-control" placeholder="M.I." name="middle_initial" maxlength="1"></div>
                                    <div class="col-md-5"><input type="text" class="form-control" placeholder="Last Name" name="last_name" required></div>
                                </div>
                                <div class="mb-3">
                                    <input type="tel"
                                        class="form-control"
                                        placeholder="Contact Number (e.g., 09123456789)"
                                        name="contact_num"
                                        pattern="09[0-9]{9}"
                                        maxlength="11"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        required> 
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="Province" name="province"></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="City" name="city"></div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Username" name="user_name" required>
                                </div>
                                <div class="mb-3"><input type="email" class="form-control" placeholder="Email Address" name="email" required></div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-12"><input type="password" class="form-control" placeholder="Password (min 8 character)" name="password" minlength="8" required></div>
                                    <div class="col-md-12"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" minlength="8" required></div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-login w-100">Register</button>
                                <div class="register-link mt-3 text-center">Already have an Account? <a href="login.php">Login</a></div>
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
                <div class="modal-header bg-success text-white">
                    <div class="modal-title"><i class="fas fa-shield-alt me-2"></i> SMS Verification</div>
                </div>
                <form id="otpForm">
                    <div class="modal-body p-4 text-center">
                        <p class="small fw-bold text-danger">Expires in: <span id="timer">01:00</span></p>
                        <input type="hidden" name="email" id="resendEmail" value="<?php echo htmlspecialchars($registeredEmail); ?>">
                        <input type="text" name="otp_input" id="otp_input" class="form-control form-control-lg text-center fw-bold" placeholder="000000" maxlength="6" required>
                        <div id="resendContainer" class="mt-3" style="display: none;">
                            <button type="button" onclick="resendOTP()" class="btn btn-link text-success text-decoration-none fw-bold">
                                <i class="fas fa-sync-alt me-1"></i> RESEND NEW CODE
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="submit" id="btnVerify" class="btn btn-success px-5 rounded-pill">Verify & Activate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../frontend/assets/js/passwordMismatch.js"></script>
    <script src="../frontend/assets/js/emailExists.js"></script>
    <script src="../frontend/assets/js/emailExistsbook.js"></script>
    <script src="assets/js/register.js"></script>
    <script>
        <?php if ($showVerificationModal): ?>
            var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                backdrop: 'static'
            });
            myModal.show();
            startCountdown(60, document.querySelector('#timer'));
        <?php endif; ?>
    </script>
</body>

</html>