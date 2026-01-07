<div class="modal fade" id="editAbout<?= $row['about_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourAbout/crud/updateAbout.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="about_id" value="<?= $row['about_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Package</label>
                        <input type="text" class="form-control bg-light" value="<?= $row['tour_name'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description Content</label>
                        <textarea name="description" class="form-control rounded-3" rows="10" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Update Description</button>
                </div>
            </form>
        </div>
    </div>
</div>