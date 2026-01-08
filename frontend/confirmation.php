<?php
session_start();
include_once "php/connect.php";

$ref = isset($_GET['ref']) ? mysqli_real_escape_string($conn, $_GET['ref']) : '';
$booking = null;

if ($ref) {

    $sql = "SELECT b.*, t.tour_name, u.contact_num 
            FROM bookings b
            JOIN tour_packages t ON b.tour_id = t.tour_id
            JOIN users u ON b.user_id = u.user_id
            WHERE b.booking_reference = '$ref'
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $booking = mysqli_fetch_assoc($result);

        $email_script = __DIR__ . "/integs/email/sendEmail.php";
        if (file_exists($email_script)) {
            require_once $email_script;
            if (function_exists('sendBookingEmail')) {
                sendBookingEmail(
                    $conn,
                    $booking['booking_id'],
                    $booking['booking_reference']
                );
            }
        }

        if (!isset($_SESSION['sms_sent_' . $ref])) {

            $sms_script = __DIR__ . "/integs/sms/sendSMS.php";
            if (file_exists($sms_script)) {
                require_once $sms_script;

                if (function_exists('sendBookingSMS')) {

                    $sms_response = sendBookingSMS(
                        $booking['contact_num'],
                        $booking['booking_reference']
                    );

                    $logFile = __DIR__ . "/integs/sms/sms_log.txt";
                    $timestamp = date("Y-m-d H:i:s");
                    file_put_contents(
                        $logFile,
                        "[$timestamp] REF:$ref | RESP:$sms_response\n",
                        FILE_APPEND
                    );

                    $_SESSION['sms_sent_' . $ref] = true;
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Booking Confirmation - EscaPinas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
body{background:#f8f9fa;font-family:Poppins,sans-serif}
.conf-card{max-width:520px;border-radius:20px}
</style>
</head>
<body>

<?php include "components/navbar.php"; ?>

<div class="container my-5 text-center">

<?php if ($booking): ?>
<div class="card shadow-lg border-0 p-4 mx-auto conf-card">
    <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
    <h3 class="fw-bold">Booking Confirmed!</h3>
    <p class="text-muted">Thank you for booking with EscaPinas.</p>

    <div class="alert alert-info small">
        <i class="fas fa-sms"></i>
        Feedback request sent to <strong><?= htmlspecialchars($booking['contact_num']) ?></strong>
    </div>

    <hr>

    <div class="text-start px-3">
        <p><strong>Reference:</strong> <?= $booking['booking_reference'] ?></p>
        <p><strong>Tour:</strong> <?= htmlspecialchars($booking['tour_name']) ?></p>
        <p><strong>Pax:</strong> <?= $booking['number_of_persons'] ?></p>
        <p><strong>Total:</strong> ₱<?= number_format($booking['total_amount'],2) ?></p>
        <p><strong>Status:</strong>
            <span class="badge bg-success"><?= strtoupper($booking['booking_status']) ?></span>
        </p>
    </div>

    <a href="profile.php?tab=bookings" class="btn btn-success rounded-pill w-100">
        View My Bookings
    </a>
</div>

<?php else: ?>
<div class="alert alert-danger mx-auto" style="max-width:500px">
    <h5>Booking Not Found</h5>
    <p>Reference: <?= htmlspecialchars($ref) ?></p>
</div>
<?php endif; ?>

</div>

</body>
</html>
