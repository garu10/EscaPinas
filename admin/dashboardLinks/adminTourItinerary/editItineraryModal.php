<div class="modal fade" id="editItinerary<?= $row['itinerary_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourItinerary/crud/updateItinerary.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Itinerary Day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="itinerary_id" value="<?= $row['itinerary_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php foreach($toursList as $t): ?>
                                <option value="<?= $t['tour_id'] ?>" <?= ($t['tour_id'] == $row['tour_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['tour_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Day Number</label>
                        <input type="number" name="day_number" class="form-control rounded-3" value="<?= $row['day_number'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Short Description</label>
                        <textarea name="short_desc" class="form-control rounded-3" rows="3" required><?= htmlspecialchars($row['short_desc']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Update Itinerary</button>
                </div>
            </form>
        </div>
    </div>
</div>