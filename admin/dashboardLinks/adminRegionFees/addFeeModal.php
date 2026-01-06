<div class="modal fade" id="addFeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminRegionFees/crud/addFee.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add Fee Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">From (Origin)</label>
                            <select name="origin_island" class="form-select rounded-3">
                                <option value="Luzon">Luzon</option>
                                <option value="Visayas">Visayas</option>
                                <option value="Mindanao">Mindanao</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">To (Destination)</label>
                            <select name="destination_island" class="form-select rounded-3">
                                <option value="Luzon">Luzon</option>
                                <option value="Visayas">Visayas</option>
                                <option value="Mindanao">Mindanao</option>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label small fw-bold">Additional Fee (₱)</label>
                            <input type="number" step="0.01" name="additional_fee" class="form-control rounded-3" placeholder="0.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Save Rule</button>
                </div>
            </form>
        </div>
    </div>
</div>