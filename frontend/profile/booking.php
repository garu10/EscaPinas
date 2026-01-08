<?php
include_once(__DIR__ . "/../../php/connect.php");

$uid = $_SESSION['user_id'] ?? null;
echo "";

if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to view your booking history.</p></div>";
    return;
}

$bookingQuery = "SELECT 
                    b.booking_id, 
                    b.total_amount AS price, 
                    b.booking_status, 
                    b.booking_reference,
                    tp.tour_name, 
                    tp.image, 
                    tp.duration_days, 
                    tp.duration_nights
                 FROM bookings b
                 LEFT JOIN tour_packages tp ON b.tour_id = tp.tour_id
                 WHERE b.user_id = $uid
                 ORDER BY b.booking_id DESC";

$bookingResult = executeQuery($bookingQuery);
?>

<h4 class="fw-bold text-success">My Booking History</h4>

<div class="mt-4">
    <?php 
    if (mysqli_num_rows($bookingResult) > 0): 
        while ($booking = mysqli_fetch_assoc($bookingResult)): 
    ?>
        <div class="payment-item mb-4">
            <div class="payment-card container-fluid p-3 shadow-sm bg-white">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <div class="payment">
                            <img src="<?= htmlspecialchars($booking['image']) ?>" class="shadow-sm">
                        </div>
                        <div>
                            <h5 class="fw-bold m-0 text-success" style="font-size: 1rem;"><?= htmlspecialchars($booking['tour_name']) ?></h5>
                            <p class="text-muted small mb-0">
                                Ref: <span class="fw-bold text-dark"><?= $booking['booking_reference'] ?></span> | 
                                <span class="badge bg-<?= $booking['booking_status'] == 'Confirmed' ? 'success' : 'warning' ?>">
                                    <?= $booking['booking_status'] ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-success fw-bold px-4 shadow-sm rounded-pill"
                                style="background-color: #0ca458; border: none;"
                                data-bs-toggle="modal" data-bs-target="#v<?= $booking['booking_id'] ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="v<?= $booking['booking_id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 24px; overflow: hidden;">
                    <div class="modal-header text-white border-0" style="background-color: #0ca458;">
                        <h5 class="fw-bold m-0">Booking Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <img src="<?= htmlspecialchars($booking['image']) ?>" 
                             class="img-fluid rounded-4 shadow mb-3" 
                             style="height: 180px; width: 100%; object-fit: cover;">
                        
                        <h4 class="fw-bold text-success mb-1"><?= htmlspecialchars($booking['tour_name']) ?></h4>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-clock"></i> <?= $booking['duration_days'] ?> Days, <?= $booking['duration_nights'] ?> Nights
                        </p>

                        <div class="row g-3 bg-light p-3 rounded-4 mx-0 border">
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Total Paid</small>
                                <span class="fw-bold text-success">₱<?= number_format($booking['price'], 2) ?></span>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Status</small>
                                <span class="fw-bold text-dark"><?= $booking['booking_status'] ?></span>
                            </div>
                            
                            <div class="col-12 border-top pt-2">
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Booking Reference</small>
                                <span class="small fw-bold text-primary"><?= $booking['booking_reference'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-secondary px-5 rounded-pill" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php 
        endwhile; 
    else: 
    ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-calendar-x text-muted display-1"></i>
            <p class="mt-3 text-muted">You haven't made any bookings yet.</p>
            <a href="packages.php" class="btn btn-success rounded-pill px-4">Find your next trip</a>
        </div>
    <?php endif; ?>
</div>