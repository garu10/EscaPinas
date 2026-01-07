<div class="modal fade" id="addInclusionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourInclusions/crud/addInclusion.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add New Inclusion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>Choose a tour...</option>
                            <?php foreach($toursList as $t): ?>
                                <option value="<?= $t['tour_id'] ?>"><?= htmlspecialchars($t['tour_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Inclusion Detail</label>
                        <input type="text" name="inclusion_detail" class="form-control rounded-3" placeholder="e.g. Free Breakfast" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Add Inclusion</button>
                </div>
            </form>
        </div>
    </div>
</div>