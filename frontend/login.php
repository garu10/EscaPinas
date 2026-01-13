<?php
session_start();
include 'php/connect.php';

// Function para sa Resend SMS
function sendSMS($to, $msg)
{
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

// Function para sa BookStack API - Check if user exists
function checkBookStackUser($identifier)
{
    $api_url = "http://192.168.1.16:8080/BookStack/api/users.php";
    
    // BookStack API requires admin credentials for authentication
    $admin_username = "Hiro Setsuya";   // BookStack admin username
    $admin_password = "Adrian1#";       // BookStack admin password
    
    try {
        // Create a stream context with Basic Auth using base64_encode
        $context = stream_context_create([
            "http" => [
                "header" => "Authorization: Basic " . base64_encode("$admin_username:$admin_password")
            ]
        ]);
        
        // Fetch the JSON data from the API
        $response = @file_get_contents($api_url, false, $context);
        
        if ($response === false) {
            error_log("BookStack API failed to retrieve data");
            return false;
        }
        
        if (empty($response)) {
            error_log("BookStack API returned empty response");
            return false;
        }
        
        // Decode JSON to PHP array
        $data = json_decode($response, true);
        
        if (!is_array($data)) {
            error_log("BookStack API response is not valid JSON: " . substr($response, 0, 200));
            return false;
        }
        
        // Handle different response formats
        // If response is a single user object (has 'user_id' key)
        if (isset($data['user_id'])) {
            // Single user object returned
            if (($data['email'] === $identifier || ($data['user_name'] ?? '') === $identifier) && ($data['is_account_verified'] ?? 0) == 1) {
                return $data;
            }
        } 
        // If response is array of users
        elseif (is_array($data) && count($data) > 0) {
            // Check if first element is a user object
            $first_key = array_key_first($data);
            
            if (isset($data[$first_key]['user_id'])) {
                // Array of user objects
                foreach ($data as $user) {
                    if (is_array($user) && isset($user['user_id'])) {
                        if (($user['email'] === $identifier || ($user['user_name'] ?? '') === $identifier) && ($user['is_account_verified'] ?? 0) == 1) {
                            return $user;
                        }
                    }
                }
            }
        }
        
        return false;
    } catch (Exception $e) {
        error_log("BookStack API Exception: " . $e->getMessage());
        return false;
    }
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
    // We call this 'identifier' because it could be an email OR a username
    $identifier = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // First, check if user exists in EscaPinas database (main database)
    $get_user = "SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier' LIMIT 1";
    $result = mysqli_query($conn, $get_user);
    
    $user_found = false;
    $user_data = null;
    
    // Check if user exists in EscaPinas database
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $user_found = true;
    } else {
        // If not found in EscaPinas database, check BookStack API
        $bookstack_user = checkBookStackUser($identifier);
        if ($bookstack_user) {
            $user_data = $bookstack_user;
            $user_found = true;
        }
    }
    
    if (!$user_found) {
        $error_msg = "No account found with that Username or Email!";
    } else {
        // Check if account is verified
        $is_verified = isset($user_data['is_account_verified']) ? $user_data['is_account_verified'] : (isset($user_data['is_verified']) ? $user_data['is_verified'] : 0);
        
        if ($is_verified == 0) {
            $error_msg = "Account not verified. Please verify your account first.";
            $show_resend = true;
            $resend_email = $user_data['email'];
        } else {
            // Verify password - try both password and password_hash fields
            $password_hash = isset($user_data['password']) ? $user_data['password'] : (isset($user_data['password_hash']) ? $user_data['password_hash'] : '');
            
            if (empty($password_hash)) {
                $error_msg = "Account password not found in system!";
            } elseif (password_verify($password, $password_hash)) {
                // Password correct - If from BookStack, insert/update into EscaPinas database
                $user_name = $user_data['user_name'] ?? $user_data['username'] ?? '';
                $email = mysqli_real_escape_string($conn, $user_data['email']);
                $phone_number = mysqli_real_escape_string($conn, $user_data['phone_number'] ?? $user_data['contact_num'] ?? '');
                $role = $user_data['role'] ?? 'user';
                
                // Check if user already exists in EscaPinas database by email
                $check_user = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";
                $check_result = mysqli_query($conn, $check_user);
                
                if ($check_result && mysqli_num_rows($check_result) > 0) {
                    // User exists, update the record (don't update user_id to avoid conflicts)
                    $existing_user = mysqli_fetch_assoc($check_result);
                    $existing_user_id = $existing_user['user_id'];
                    
                    $update_query = "UPDATE users SET 
                        username = '$user_name',
                        contact_num = '$phone_number',
                        role = '$role',
                        password = '$password_hash',
                        is_verified = '$is_verified'
                        WHERE email = '$email'";
                    mysqli_query($conn, $update_query);
                    
                    // Use the existing user_id for session
                    $_SESSION['user_id'] = $existing_user_id;
                } else {
                    // New user from BookStack, insert into database WITHOUT specifying user_id
                    // This allows the database to auto-generate a unique user_id
                    $insert_query = "INSERT INTO users (
                        username, 
                        email, 
                        contact_num, 
                        role, 
                        password, 
                        is_verified
                    ) VALUES (
                        '$user_name',
                        '$email',
                        '$phone_number',
                        '$role',
                        '$password_hash',
                        '$is_verified'
                    )";
                    
                    if (mysqli_query($conn, $insert_query)) {
                        // Get the auto-generated user_id
                        $_SESSION['user_id'] = mysqli_insert_id($conn);
                    } else {
                        error_log("Database Insert Error: " . mysqli_error($conn));
                        // Still set session with BookStack user_id if insert fails
                        $_SESSION['user_id'] = $user_data['user_id'] ?? '';
                    }
                }
                
                // Set session data
                $_SESSION['username'] = $user_name; 
                $_SESSION['user_name'] = $user_name;
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['role'] = $role;

                // Redirect to home page for all users
                header("Location: ../index.php");
                exit();
            } else {
                $error_msg = "Invalid Password!";
            }
        }
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
</body>

</html>