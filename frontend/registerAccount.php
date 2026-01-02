<?php
include 'php/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect inputs
    $fname = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $contact_num = $_POST['contact_num'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    // 2. Validation
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // 3. Security Measures
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';

    // 4. Check email uniqueness
    $checkEmail = "SELECT email FROM users WHERE email = '$email'";
    $result = executeQuery($checkEmail);

    if ($result->num_rows > 0) {
        // Trigger Error Modal
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        </script>";
    } else {
        // 5. Build the Query for your executeQuery function
        $insertUser = "INSERT INTO users (first_name, last_name, middle_initial, contact_num, province, city, email, password, role) 
                   VALUES ('$fname', '$last_name', '$middle_initial', '$contact_num', '$province', '$city', '$email', '$hashed_password', '$role')";

        // 6. Execute using your custom function
        if (executeQuery($insertUser)) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myModal.show();
                    
                    // Redirect when the green button is clicked
                    document.getElementById('btnRedirect').addEventListener('click', function() {
                        window.location.href = 'login.php';
                    });
                });
            </script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
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
                                    <div class="form-check-label small text-white" for="terms">
                                        I agree to the <a href="#" class="text-white fw-bold">Terms & Conditions</a>
                                    </div>
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
                    <p class="text-muted">Your account has been created successfully. You can now start exploring Philippine tour packages.</p>
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
                    <div class="text-muted">The email address you entered is already associated with an account. Please use a different email or try logging in.</div>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Try Again</button>
                    <a href="login.php" class="btn btn-danger px-4 rounded-pill">Go to Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>