<style>
    .star-rating { display: flex; flex-direction: row-reverse; justify-content: center; gap: 8px; }
    .star-rating input { display: none; }
    .star-rating label { font-size: 2.2rem; color: #ddd; cursor: pointer; transition: 0.2s; }
    .star-rating label:hover, .star-rating label:hover ~ label, .star-rating input:checked ~ label { color: #ffc107; }
    .star-rating label::before { content: "\F586"; font-family: "bootstrap-icons"; }
</style>

<div class="modal fade" id="reviewModal<?php echo $booking['booking_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-success">Rate Your Experience</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="profile/api/submit_review.php" method="POST">
                <div class="modal-body px-4 text-center">
                    <input type="hidden" name="tour_id" value="<?php echo $booking['tour_id'] ?>">
                    <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id'] ?>">

                    <div class="star-rating mb-4">
                        <input type="radio" id="s5-<?php echo $booking['booking_id'] ?>" name="rating_score" value="5" required /><label for="s5-<?php echo $booking['booking_id'] ?>"></label>
                        <input type="radio" id="s4-<?php echo $booking['booking_id'] ?>" name="rating_score" value="4" /><label for="s4-<?php echo $booking['booking_id'] ?>"></label>
                        <input type="radio" id="s3-<?php echo $booking['booking_id'] ?>" name="rating_score" value="3" /><label for="s3-<?php echo $booking['booking_id'] ?>"></label>
                        <input type="radio" id="s2-<?php echo $booking['booking_id'] ?>" name="rating_score" value="2" /><label for="s2-<?php echo $booking['booking_id'] ?>"></label>
                        <input type="radio" id="s1-<?php echo $booking['booking_id'] ?>" name="rating_score" value="1" /><label for="s1-<?php echo $booking['booking_id'] ?>"></label>
                    </div>

                    <textarea class="form-control border-0 bg-light rounded-4 p-3" name="review_text" rows="4" placeholder="How was the tour? (Optional)" style="resize: none;"></textarea>
                </div>
                <div class="modal-footer border-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted" data-bs-dismiss="modal">Skip</button>
                    <button type="submit" class="btn btn-success flex-grow-1 rounded-pill py-2 fw-bold shadow-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>