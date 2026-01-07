<?php
session_start();
include_once "php/connect.php"; // Siguraduhing tama ang path nito

$ref = isset($_GET['ref']) ? mysqli_real_escape_string($conn, $_GET['ref']) : '';
$booking = null;

if ($ref) {
    $sql = "SELECT b.*, t.tour_name 
            FROM bookings b 
            JOIN tour_packages t ON b.tour_id = t.tour_id 
            WHERE b.booking_reference = '$ref' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $booking = mysqli_fetch_assoc($result);
        
        // --- EMAIL TRIGGER ---
        $email_script = __DIR__ . "/integs/email/sendEmail.php"; 
        if (file_exists($email_script)) {
            require_once $email_script;
            if (function_exists('sendBookingEmail')) {
                // I-send ang email gamit ang ID at Ref mula sa DB
                sendBookingEmail($conn, $booking['booking_id'], $booking['booking_reference']);
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .conf-card { max-width: 500px; border-radius: 20px; }
        .success-icon { color: #198754; animation: scaleUp 0.5s ease-out; }
        @keyframes scaleUp { from { transform: scale(0); } to { transform: scale(1); } }
    </style>
</head>
<body>

    <?php include "components/navbar.php"; ?>

    <div class="container my-5 text-center">
        <?php if ($booking): ?>
            <div class="card shadow-lg border-0 p-4 mx-auto conf-card">
                <div class="success-icon mb-3">
                    <i class="fas fa-check-circle fa-5x"></i>
                </div>
                <h2 class="fw-bold">Booking Confirmed!</h2>
                <p class="text-muted">Thank you for your payment. Your adventure is ready!</p>

                <hr>

                <div class="text-start px-3">
                    <p class="mb-2"><strong>Reference No:</strong> <span class="text-success fw-bold"><?php echo $booking['booking_reference']; ?></span></p>
                    <p class="mb-2"><strong>Tour:</strong> <?php echo htmlspecialchars($booking['tour_name']); ?></p>
                    <p class="mb-2"><strong>Pax:</strong> <?php echo $booking['number_of_persons']; ?> Person(s)</p>
                    <p class="mb-2"><strong>Total Amount:</strong> ₱<?php echo number_format($booking['total_amount'], 2); ?></p>
                    <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success"><?php echo strtoupper($booking['booking_status']); ?></span></p>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="profile.php?tab=bookings" class="btn btn-success rounded-pill">View My Bookings</a>
                    <a href="/EscaPinas/index.php" class="btn btn-outline-secondary rounded-pill">Back to Home</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger mx-auto shadow-sm" style="max-width: 500px; border-radius: 15px;">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h4 class="fw-bold">Booking Not Found</h4>
                <p>We couldn't find any record for reference: <strong><?php echo htmlspecialchars($ref); ?></strong></p>
                <a href="/EscaPinas/index.php" class="btn btn-danger rounded-pill px-4">Go Back to Home</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>