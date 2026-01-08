<div class="modal fade" id="editVoucher<?= $v['template_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0">
                <h5 class="fw-bold text-primary">Update Voucher Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="dashboardLinks/adminVouchers/crud/updateVoucher.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="template_id" value="<?= $v['template_id'] ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Voucher Title</label>
                        <input type="text" name="title" class="form-control"
                            value="<?= htmlspecialchars($v['title']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Voucher Code</label>
                            <input type="text" name="code" class="form-control"
                                value="<?= htmlspecialchars($v['code']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">System Type</label>
                            <select name="system_type" class="form-select">
                                <option value="travel_agency" <?= $v['System_type'] == 'travel_agency' ? 'selected' : '' ?>>Travel Agency</option>
                                <option value="ebook_store" <?= $v['System_type'] == 'ebook_store' ? 'selected' : '' ?>>E-Book Store</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Discount Type</label>
                            <select name="discount_type" class="form-select">
                                <option value="fixed" <?= $v['discount_type'] == 'fixed' ? 'selected' : '' ?>>Fixed (₱)</option>
                                <option value="percentage" <?= $v['discount_type'] == 'percentage' ? 'selected' : '' ?>>Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Amount</label>
                            <input type="number" name="discount_amount" class="form-control"
                                value="<?= $v['discount_amount'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Min. Spend</label>
                            <input type="number" step="0.01" name="min_spend" class="form-control"
                                value="<?= $v['min_order_amount'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Expiry Date</label>
                            <input type="date" name="expires_at" class="form-control"
                                value="<?= date('Y-m-d', strtotime($v['expires_at'])) ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_voucher" class="btn btn-primary rounded-pill px-4">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>