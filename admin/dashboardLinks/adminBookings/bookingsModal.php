<div class="modal fade" id="editBooking<?= $row['booking_id'] ?>" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
        <form action="dashboardLinks/adminBookings/crud/updateBooking.php" method="POST">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold text-success m-0">Review Booking Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                <div class="bg-light p-3 rounded-3 mb-4 border">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <small class="text-muted d-block uppercase" style="font-size: 0.65rem;">Reference</small>
                            <span class="fw-bold"><?= $row['booking_reference'] ?></span>
                        </div>
                        <div class="col-6 mb-2">
                            <small class="text-muted d-block uppercase" style="font-size: 0.65rem;">Total Amount</small>
                            <span class="fw-bold text-success">₱<?= number_format($row['total_amount'], 2) ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold small">Action</label>
                    <select name="booking_status" class="form-select rounded-3">
                        <option value="Pending" <?= $row['booking_status'] == 'Pending' ? 'selected' : '' ?>>Keep as Pending</option>
                        <option value="Confirmed" <?= $row['booking_status'] == 'Confirmed' ? 'selected' : '' ?>>Confirm Booking</option>
                        <option value="Cancelled" <?= $row['booking_status'] == 'Cancelled' ? 'selected' : '' ?>>Cancel Booking</option>
                    </select>
                    <small class="text-muted mt-2 d-block">Updating to "Confirmed" will notify the client.</small>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Update Booking</button>
            </div>
        </form>
    </div>
</div>
</div>