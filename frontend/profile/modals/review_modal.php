<style>
    /* Star Rating Logic */
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 2.5rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s ease-in-out;
}

.star-rating label:before {
    content: "\F586"; /* Bootstrap Icon bi-star-fill code */
    font-family: "bootstrap-icons";
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #ffc107; /* Gold color */
}

/* Modal animation smooth */
.modal.fade .modal-dialog {
    transform: scale(0.9);
    transition: transform 0.3s ease-out;
}
.modal.show .modal-dialog {
    transform: scale(1);
}
</style>

<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" id="reviewModalLabel">Share Your Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/EscaPinas/frontend/php/submit_review.php" method="POST">
                <div class="modal-body px-4">
                    <p class="text-muted small">How was your trip with EscaPinas? Your feedback helps us improve.</p>
                    
                    <div class="text-center my-4">
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                        </div>
                        <div class="mt-2 fw-semibold text-success">Select a Rating</div>
                    </div>

                    <div class="mb-3">
                        <label for="review_text" class="form-label fw-bold">Your Review</label>
                        <textarea class="form-control border-0 bg-light" id="review_text" name="review_text" rows="4" placeholder="Tell us about the tour, the guide, or the food..." style="border-radius: 15px; resize: none;" required></textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4 justify-content-center">
                    <button type="submit" class="btn btn-success px-5 rounded-pill fw-bold">Submit Review</button>
                    <button type="button" class="btn btn-light px-4 rounded-pill text-muted" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>