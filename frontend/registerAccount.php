<?php
include("php/connect.php");

$showVerificationModal = isset($_GET['verify']) ? true : false;
$registeredEmail = isset($_GET['email']) ? mysqli_real_escape_string($conn, $_GET['email']) : ""; 

function formatPhone($number) {
    $number = preg_replace('/[^0-9+]/', '', $number);
    if(substr($number, 0, 1) == "0") { 
        $number = "+63" . substr($number, 1); 
    }
    return $number;
}

function sendSMS($to, $msg) {
    $to = formatPhone($to);

    $url = "https://api.sms-gate.app/3rdparty/v1/messages";
    $payload = ["phoneNumbers" => [$to], "textMessage" => ["text" => $msg]];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "ADUWE4:6o7hu2uyguo7do"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    if ($result === false) {
        error_log("SMS Error: " . curl_error($ch));
    }
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

    if ($password !== $confirm_password) {
        echo "<script>alert('Error: Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $otp_code = rand(100000, 999999); 
    date_default_timezone_set('Asia/Manila');
    $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minute'));

    $checkEmail = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $checkEmail);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!'); window.history.back();</script>";
    } else {
        $insertUser = "INSERT INTO users (first_name, last_name, middle_initial, contact_num, province, city, email, password, role, is_verified, verification_code, otp_expiry) 
                       VALUES ('$fname', '$last_name', '$middle_initial', '$contact_num', '$province', '$city', '$email', '$hashed_password', 'user', 0, '$otp_code', '$expiry_time')";

        if (mysqli_query($conn, $insertUser)) {
            sendSMS($contact_num, "EscaPinas: Ang iyong code ay $otp_code. Valid ito sa loob ng 1 minuto.");   
            header("Location: registerAccount.php?verify=true&email=" . urlencode($email));
            exit();
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
                            <form method="POST">
                                <div class="row g-2 mb-3">
                                    <div class="col-md-5"><input type="text" class="form-control" placeholder="First Name" name="first_name" required></div>
                                    <div class="col-md-2"><input type="text" class="form-control" placeholder="M.I." name="middle_initial" maxlength="1"></div>
                                    <div class="col-md-5"><input type="text" class="form-control" placeholder="Last Name" name="last_name" required></div>
                                </div>
                                <div class="mb-3"><input type="text" class="form-control" placeholder="Contact Number" name="contact_num" required></div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="Province" name="province"></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="City" name="city"></div>
                                </div>
                                <div class="mb-3"><input type="email" class="form-control" placeholder="Email Address" name="email" required></div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6"><input type="password" class="form-control" placeholder="Password" name="password" required></div>
                                    <div class="col-md-6"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required></div>
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
    <script>
    let countdown;
    function startCountdown(duration, display) {
        let timer = duration, minutes, seconds;
        clearInterval(countdown);
        countdown = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            display.textContent = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            if (--timer < 0) {
                clearInterval(countdown);
                document.getElementById('btnVerify').disabled = true;
                document.getElementById('otp_input').disabled = true;
                document.getElementById('resendContainer').style.display = 'block';
            }
        }, 1000);
    }

    function resendOTP() {
        let emailInput = document.getElementById('resendEmail');
        let email = emailInput.value;
        
        if (!email) {
            alert("Email not found. Please refresh the page.");
            return;
        }

        const resendBtn = document.querySelector('#resendContainer button');
        resendBtn.disabled = true;
        resendBtn.innerText = "Sending...";

        fetch('integs/sms/resend_logic.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'email=' + encodeURIComponent(email)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Bagong code ang ipinadala!');
                document.getElementById('btnVerify').disabled = false;
                document.getElementById('otp_input').disabled = false;
                document.getElementById('otp_input').value = '';
                document.getElementById('resendContainer').style.display = 'none';
                
                clearInterval(countdown);
                startCountdown(60, document.querySelector('#timer'));
            } else { 
                alert('Error: ' + data.message); 
            }
        })
        .catch(err => {
            console.error(err);
            alert("Connection Error: Pakisiguro na stable ang internet.");
        })
        .finally(() => {
            resendBtn.disabled = false;
            resendBtn.innerText = "RESEND NEW CODE";
        });
    }

    document.getElementById('otpForm').addEventListener('submit', function(e){
        e.preventDefault();
        const email = document.getElementById('resendEmail').value;
        const otp = document.getElementById('otp_input').value;

        if(!otp){
            alert("Pakilagay ang OTP code.");
            return;
        }

        fetch('integs/sms/verify_otp.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `email=${encodeURIComponent(email)}&otp_input=${encodeURIComponent(otp)}`
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                alert(data.message);
                window.location.href = 'login.php';
            } else {
                alert(data.message);
            }
        })
        .catch(err=>{
            console.error(err);
            alert("Connection error. Pakisiguro ang internet.");
        });
    });

    <?php if ($showVerificationModal): ?>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'), {backdrop: 'static'});
        myModal.show();
        startCountdown(60, document.querySelector('#timer'));
    <?php endif; ?>
    </script>
</body>
</html>
