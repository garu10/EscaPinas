<div class="modal fade" id="editTour<?= $tour['tour_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourpackages/crud/updateTour.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="tour_id" value="<?= $tour['tour_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Name</label>
                        <input type="text" name="tour_name" class="form-control" value="<?= $tour['tour_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Price (PHP)</label>
                        <input type="number" name="price" class="form-control" value="<?= $tour['price'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="Available" <?= $tour['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                            <option value="Unavailable" <?= $tour['status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill">Update Package</button>
                </div>
            </form>
        </div>
    </div>
</div>