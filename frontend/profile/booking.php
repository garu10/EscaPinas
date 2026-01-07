<?php
include_once __DIR__ . "/../php/connect.php"; 

$uid = $_SESSION['user_id'] ?? null;
if (!$uid) {
    echo "<p class='text-center py-5 text-muted'>Please log in to view your history.</p>";
    return;
}

// 1. Siguraduhin na kasama ang b.* para makuha ang lahat ng columns sa bookings table
$bookingQuery = "SELECT b.*, tp.tour_name, tp.image, 
                (SELECT COUNT(*) FROM ratings r WHERE r.tour_id = b.tour_id AND r.user_id = b.user_id) as review_count
                FROM bookings b
                LEFT JOIN tour_packages tp ON b.tour_id = tp.tour_id
                WHERE b.user_id = $uid ORDER BY b.booking_id DESC";

$bookingResult = executeQuery($bookingQuery);
?>

<h4 class="fw-bold text-success mb-4">My Booking History</h4>

<div class="booking-list">
    <?php if (mysqli_num_rows($bookingResult) > 0): ?>
        <?php while ($booking = mysqli_fetch_assoc($bookingResult)): 
            // 2. Logic para sa Status Badge
            $status = htmlspecialchars($booking['booking_status'] ?? 'Pending');
            
            // Dynamic color selection
            $badgeColor = 'bg-warning text-dark'; // Default (Pending)
            if ($status == 'Confirmed') $badgeColor = 'bg-success text-white';
            if ($status == 'Cancelled' || $status == 'Failed') $badgeColor = 'bg-danger text-white';
        ?>
            
            <div class="payment-card container-fluid p-3 shadow-sm bg-white border mb-3" style="border-radius: 15px;">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <img src="<?= htmlspecialchars($booking['image']) ?>" style="width: 65px; height: 65px; object-fit: cover; border-radius: 12px;">
                        <div>
                            <h6 class="fw-bold m-0 text-dark"><?= htmlspecialchars($booking['tour_name']) ?></h6>
                            <small class="text-muted d-block">Ref: <?= $booking['booking_reference'] ?></small>
                            <span class="badge <?= $badgeColor ?> mt-1" style="font-size: 0.65rem; border-radius: 50px; padding: 4px 10px;">
                                <?= strtoupper($status) ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#receipt<?= $booking['booking_id'] ?>">
                            View Receipt
                        </button>
                    </div>
                </div>
            </div>

            <?php 
                include 'modals/modal_receipt.php'; 
                include 'modals/modal_review.php'; 
            ?>

        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center text-muted py-5">No booking history found.</p>
    <?php endif; ?>
</div>

<script>
// Cleanup script para sa modal backdrop
document.addEventListener('hidden.bs.modal', function () {
    if (!document.querySelector('.modal.show')) {
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(b => b.remove());
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
    }
});
</script>