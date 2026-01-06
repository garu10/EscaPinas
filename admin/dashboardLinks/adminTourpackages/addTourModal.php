<div class="modal fade" id="addTourModal" tabindex="-1" aria-labelledby="addTourModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="dashboardLinks/adminTourpackages/crud/addTour.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0" id="addTourModalLabel">Create New Tour Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Name</label>
                        <input type="text" name="tour_name" class="form-control rounded-3" placeholder="e.g. Boracay 3-Day Getaway" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Days</label>
                            <input type="number" name="duration_days" class="form-control rounded-3" placeholder="0" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Nights</label>
                            <input type="number" name="duration_nights" class="form-control rounded-3" placeholder="0" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Price (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">₱</span>
                                <input type="number" step="0.01" name="price" class="form-control rounded-3 border-start-0" placeholder="0.00" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Briefly describe what makes this tour special..." required></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Initial Status</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="Available" selected>Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Image Filename</label>
                            <input type="text" name="image_name" class="form-control rounded-3" placeholder="e.g. boracay.jpg" required>
                            <small class="text-muted" style="font-size: 0.7rem;">File must exist in <code>assets/images/</code></small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Create Package</button>
                </div>
            </form>
        </div>
    </div>
</div>