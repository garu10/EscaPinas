<div class="modal fade" id="addItineraryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourItinerary/crud/addItinerary.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add Itinerary Day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>Choose tour...</option>
                            <?php foreach($toursList as $t): ?>
                                <option value="<?= $t['tour_id'] ?>"><?= htmlspecialchars($t['tour_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Day Number</label>
                        <input type="number" name="day_number" class="form-control rounded-3" placeholder="e.g. 1" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Short Description</label>
                        <textarea name="short_desc" class="form-control rounded-3" rows="3" placeholder="Describe the day's highlights..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Save Itinerary</button>
                </div>
            </form>
        </div>
    </div>
</div>