<div class="modal fade" id="editDest<?= $row['destination_id'] ?>" tabindex="-1" aria-labelledby="editDestLabel<?= $row['destination_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="dashboardLinks/adminDestinations/crud/updateDest.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0" id="editDestLabel<?= $row['destination_id'] ?>">Update Destination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="destination_id" value="<?= $row['destination_id'] ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Destination Name</label>
                        <input type="text" name="destination_name" class="form-control rounded-3" 
                               value="<?= htmlspecialchars($row['destination_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="4" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Operational Status</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="active<?= $row['destination_id'] ?>" 
                                       value="Active" <?= $row['status'] == 'Active' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="active<?= $row['destination_id'] ?>">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="inactive<?= $row['destination_id'] ?>" 
                                       value="Inactive" <?= $row['status'] == 'Inactive' ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="inactive<?= $row['destination_id'] ?>">Inactive</label>
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                            Inactive destinations will not be visible to customers on the frontend.
                        </small>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Update Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>