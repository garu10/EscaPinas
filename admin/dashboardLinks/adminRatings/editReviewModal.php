<div class="modal fade" id="editReview<?= $rev['review_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminRatings/crud/updateReview.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="review_id" value="<?= $rev['review_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Rating Score (1-5)</label>
                        <select name="rating_score" class="form-select rounded-3">
                            <?php for($i=5; $i>=1; $i--): ?>
                                <option value="<?= $i ?>" <?= $rev['rating_score'] == $i ? 'selected' : '' ?>><?= $i ?> Stars</option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Review Text</label>
                        <textarea name="review_text" class="form-control rounded-3" rows="4"><?= $rev['review_text'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Update Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>