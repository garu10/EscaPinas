<div class="modal fade" id="editPayment<?= $pay['payment_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminPayments/crud/updatePayment.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Update Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="payment_id" value="<?= $pay['payment_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Payment Status</label>
                        <select name="payment_status" class="form-select rounded-3">
                            <option value="COMPLETED" <?= $pay['payment_status'] == 'COMPLETED' ? 'selected' : '' ?>>COMPLETED</option>
                            <option value="PENDING" <?= $pay['payment_status'] == 'PENDING' ? 'selected' : '' ?>>PENDING</option>
                            <option value="REFUNDED" <?= $pay['payment_status'] == 'REFUNDED' ? 'selected' : '' ?>>REFUNDED</option>
                            <option value="FAILED" <?= $pay['payment_status'] == 'FAILED' ? 'selected' : '' ?>>FAILED</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Amount (Manual Adjust)</label>
                        <input type="number" step="0.01" name="amount" class="form-control rounded-3" value="<?= $pay['amount'] ?>">
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>