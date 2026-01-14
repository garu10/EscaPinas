<?php
session_start();
include_once("../frontend/php/connect.php");

if (isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin') {
    header("Location: adminDashboard.php");
    exit();
}
$title = "| Admin Login - EscaPinas Tour & Travel";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND role = 'admin' LIMIT 1";

    $result = executeQuery($query);

    if ($result && $user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['role'] = 'admin';

            header("Location: adminDashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Admin account not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'adminComponents/head.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="..\admin\adminComponents\css\adminLogin.css">

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <div class="h3 mt-3 fw-bold text-success">Admin Access</div>
                        <div class="text-muted small">Please enter your admin credentials</div>
                    </div>
                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2 small text-center"><?= $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="username" class="form-control border-start-0" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-admin w-100 fw-bold">Login to Dashboard</button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="../index.php" class="text-decoration-none small text-muted"><i class="fas fa-arrow-left me-1"></i> Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>