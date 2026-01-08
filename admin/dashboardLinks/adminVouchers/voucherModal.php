<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0">
                <h5 class="fw-bold text-success">Create New Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="dashboardLinks/adminVouchers/crud/createVoucher.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Voucher Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Summer Getaway Discount" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Voucher Code</label>
                            <input type="text" name="code" class="form-control" placeholder="SUMMER2024" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">System Type</label>
                            <select name="System_type" class="form-select">
                                <option value="travel_agency">Travel Agency</option>
                                <option value="ebook_store">E-Book Store</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Discount Type</label>
                            <select name="discount_type" class="form-select">
                                <option value="fixed">Fixed Amount (₱)</option>
                                <option value="percentage">Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Discount Amount</label>
                            <input type="number" step="0.01" name="discount_amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Min. Spend (₱)</label>
                            <input type="number" step="0.01" name="min_order_amount" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Expiry Date</label>
                            <input type="date" name="expires_at" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Save Voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>