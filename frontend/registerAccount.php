<?php
// need kasama yung folder name pala
include 'php/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collection of inputs from the form
    $fname =  $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // validation (basic validation for the password confirmation)
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // hashing the password (basic security measure)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';

    // check email uniqueness (can be use for the email integration later)
    $checkEmail = "SELECT email FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);
    //check if email exists and no duplicate
    if ($result->num_rows > 0) {
        echo "Email already registered!";
    } else {
        $insertUser = "INSERT INTO users (first_name, last_name, email, password, role) 
                       VALUES ('$fname', '$last_name', '$email', '$hashed_password', '$role')";
        // execute the query
        executeQuery($insertUser);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>

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
                                <div class="welcome-text text-start">
                                    <div class="h2 text-start">Magandang Araw!<br>Join Us Today!</div>
                                    <div class="lead">Register to manage Philippine tour packages with ease and
                                        precision.</div>
                                </div>
                            </div>

                            <div class="col-md-7 login-section p-5">
                                <div class="login-header h2 text-center mb-4">Create an Account</div>
                                <form method="POST">
                                    <div class="row g-2">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="terms">
                                        <div class="form-check-label small text-white" for="terms">
                                            I agree to the <a href="#" class="text-white fw-bold">Terms & Conditions</a>
                                            <br>
                                            <div class="span">Allow EscaPinas to
                                                process my personal data for booking services</div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-login">Register</button>

                                    <div class="register-link">
                                        Already have an Account? <a href="login.php">Login</a>
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