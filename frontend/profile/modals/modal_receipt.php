<div class="modal fade" id="receipt<?= $booking['booking_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            
            <div class="position-relative">
                <img src="<?= htmlspecialchars($booking['image']) ?>" class="w-100" style="height: 350px; object-fit: cover;">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 shadow-none" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body px-4 py-4 text-center">
                <h5 class="fw-bold text-success mb-3"><?= htmlspecialchars($booking['tour_name']) ?></h5>
                
                <div class="p-3 bg-light rounded-4 border mb-4">
                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">BOOKING CONFIRMATION</small>
                    <code class="fs-4 text-dark fw-bold"><?= htmlspecialchars($booking['booking_reference']) ?></code>
                </div>

                <?php if($booking['booking_status'] == 'Confirmed' && $booking['review_count'] == 0): ?>
                    <button class="btn btn-outline-success w-100 rounded-pill py-3 fw-bold mb-2" 
                            data-bs-toggle="modal" 
                            data-bs-target="#reviewModal<?= $booking['booking_id'] ?>" 
                            data-bs-dismiss="modal">
                        Write a Review (Optional)
                    </button>
                <?php else: ?>
                    <div class="badge bg-success-subtle text-success px-4 py-2 rounded-pill">
                        <i class="bi bi-check-circle-fill me-1"></i> <?= $booking['booking_status'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>