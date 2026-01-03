<?php
session_start();
include_once "php/connect.php"; 
include "components/navbar.php";

$ref = isset($_GET['ref']) ? mysqli_real_escape_string($conn, $_GET['ref']) : '';

if ($ref) {
    $sql = "SELECT b.*, t.tour_name, t.price 
            FROM bookings b 
            JOIN tour_packages t ON b.tour_id = t.tour_id 
            WHERE b.booking_reference = '$ref'";
    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_assoc($result); 
}
?>

<div class="container my-5 text-center">
    <?php if ($booking): ?>
        <div class="card shadow-lg border-0 p-4 mx-auto" style="max-width: 500px; border-radius: 20px;">
            <div class="text-success mb-3">
                <i class="fas fa-check-circle fa-5x"></i>
            </div>
            <h2 class="fw-bold">Booking Confirmed!</h2>
            <p class="text-muted">Thank you for your payment. Your adventure is ready!</p>
            
            <hr>
            
            <div class="text-start px-3">
                <p><strong>Reference No:</strong> <span class="text-success"><?php echo $booking['reference_no']; ?></span></p>
                <p><strong>Tour:</strong> <?php echo $booking['tour_name']; ?></p>
                <p><strong>Pax:</strong> <?php echo $booking['pax_count']; ?></p>
                <p><strong>Pickup:</strong> <?php echo $booking['pickup_location']; ?></p> <!--hindi ito nagaan kasi sa bookingForm di naounta sa db ang mga pickup info-->
                <p><strong>Status:</strong> <span class="badge bg-success">PAID</span></p>
            </div>
            
            <hr>
            
            <div class="d-grid gap-2">
                <a href="profile.php" class="btn btn-primary rounded-pill">View My Bookings</a>
                <a href="index.php" class="btn btn-outline-secondary rounded-pill">Back to Home</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            <h4>Invalid Reference Number</h4>
            <p>We couldn't find any booking with that reference. Please contact support.</p>
            <a href="index.php" class="btn btn-danger">Go Home</a>
        </div>
    <?php endif; ?>
</div>

<?php include "components/footer.php"; ?>   