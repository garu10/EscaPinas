<?php
// STATIC DESIGN NG REVIEW HISTORY PAGE
$myReviews = [
    [
        "tour_name" => "Baguio and Sagada Tour Package",
        "rating" => 5,
        "date" => "Dec 15, 2024",
        "comment" => "The trip was unforgettable! The tour guide was very knowledgeable and the itinerary was well-paced.",
        "image" => "assets/images/baguio1.jpg"
    ],
    [
        "tour_name" => "Palawan Island Hopping",
        "rating" => 4,
        "date" => "Oct 20, 2024",
        "comment" => "Great experience, though the boat ride was a bit long. The beaches are crystal clear!",
        "image" => "assets/images/package2.jpg"
    ]
];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold text-success mb-0">My Review History</h4>
        <p class="text-muted small">Here are the reviews you've shared about your past travels.</p>
    </div>
    <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#addReviewModal">
        <i class="bi bi-plus-lg"></i> Write
    </button>
</div>

<div class="row g-3">
    <?php if (!empty($myReviews)): ?>
        <?php foreach ($myReviews as $review): ?>
            <div class="col-md-6">
                <div class="review-box card h-100">
                    <div class="position-relative">
                        <img src="<?= $review['image']; ?>" class="review-img-top" alt="Tour">
                        <span class="badge bg-white text-dark position-absolute bottom-0 end-0 m-2 border" style="font-size: 10px;">
                            <?= $review['date']; ?>
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="fw-bold text-success mb-1 text-truncate" style="font-size: 14px;">
                            <?= strtoupper($review['tour_name']); ?>
                        </div>
                        <div class="mb-2">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="bi bi-star-fill <?= $i <= $review['rating'] ? 'text-warning' : 'text-light' ?>" style="font-size: 11px;"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="card-text text-dark" style="font-size: 12.5px; line-height: 1.4;">
                            "<?= $review['comment']; ?>"
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5 border" style="border-radius: 15px; background: #f9f9f9; border-style: dashed !important;">
            <p class="text-muted mb-0">No reviews yet.</p>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold text-success" id="addReviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Choose a tour you've finished</option>
                            <option value="1">Baguio and Sagada</option>
                            <option value="2">Palawan Island Hopping</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Your Feedback</label>
                        <textarea class="form-control rounded-3" rows="4" placeholder="How was your experience?" maxlength="255"></textarea>
                        <div class="form-text text-end" style="font-size: 10px;">Max 255 characters</div>
                    </div>
                    <button type="button" class="btn btn-success w-100 rounded-pill fw-bold py-2">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .review-box {
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
        border: 1px solid #dee2e6 !important; 
        border-bottom: 5px solid #1aa866 !important;
        height: 100%;
    }
    .review-img-top { height: 140px; width: 100%; object-fit: cover; }
    .text-warning { color: #ffc107 !important; }
    .text-light { color: #e9ecef !important; }
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-style: italic;
    }
</style>

<?php
/*
// need gawin pag icconnect na sa db para gawing live ang review submission form

<form action="php/submit_review.php" method="POST"> <div class="mb-3">
        <label class="form-label small fw-bold">Select Tour</label>
        <select name="tour_id" class="form-select rounded-3" required>
            <option selected disabled>Choose a tour you've finished</option>
            <option value="1">Baguio and Sagada</option>
            <option value="2">Palawan Island Hopping</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label small fw-bold">Your Feedback</label>
        <textarea name="review_text" class="form-control rounded-3" rows="4" 
                  placeholder="How was your experience?" maxlength="255" required></textarea>
        <div class="form-text text-end" style="font-size: 10px;">Max 255 characters</div>
    </div>
    <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2">Submit Review</button>
</form>

gumawa ng submit_reviews.php:

    <?php
session_start();
include 'connect.php'; // Siguraduhin na ito ang tamang path ng DB connection mo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang user_id sa session (dapat naka-login ang user)
    $user_id = $_SESSION['user_id'] ?? null;
    
    // Kunin ang data mula sa form
    $tour_id = $_POST['tour_id'];
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);

    if ($user_id && $tour_id && $review_text) {
        // SQL query base sa structure ng table mo
        $sql = "INSERT INTO ratings (user_id, tour_id, review_text) 
                VALUES ('$user_id', '$tour_id', '$review_text')";

        if ($conn->query($sql) === TRUE) {
            // Pag success, babalik sa profile page sa reviews section
            header("Location: ../profile.php?page=reviews&status=success");
            exit();
        } else {
            echo 'Error: ' . $conn->error;
        }
    } else {
        echo 'Please login and fill all fields.';
    }
}
?>
*/