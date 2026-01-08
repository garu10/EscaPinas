<?php
session_start();
include_once __DIR__ . "/../../php/connect.php";

$uid = $_SESSION['user_id'] ?? null;
if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to view reviews.</p></div>";
    return;
}

$today = date('Y-m-d');

// 1. QUERY: Mga bookings na tapos na ang tour pero wala pang rating
$toRateQuery = "SELECT b.booking_id, b.tour_id, tp.tour_name, tp.image, s.end_date 
                FROM bookings b
                JOIN tour_schedules s ON b.schedule_id = s.schedule_id
                JOIN tour_packages tp ON b.tour_id = tp.tour_id
                LEFT JOIN ratings r ON (r.tour_id = b.tour_id AND r.user_id = b.user_id)
                WHERE b.user_id = $uid 
                AND b.booking_status = 'Confirmed'
                AND s.end_date < '$today'
                AND r.review_id IS NULL";
$toRateResult = executeQuery($toRateQuery);

// 2. QUERY: Lahat ng ratings na nagawa na ng user
$myReviewsQuery = "SELECT r.*, tp.tour_name, tp.image 
                   FROM ratings r
                   JOIN tour_packages tp ON r.tour_id = tp.tour_id
                   WHERE r.user_id = $uid
                   ORDER BY r.review_id DESC";
$myReviewsResult = executeQuery($myReviewsQuery);
?>

<style>
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        gap: 8px;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 2.2rem;
        color: #ddd;
        cursor: pointer;
        transition: 0.2s;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input:checked~label {
        color: #ffc107;
    }

    .star-rating label::before {
        content: "\F586";
        font-family: "bootstrap-icons";
    }

    .nav-pills .nav-link.active {
        background-color: #198754 !important;
    }
</style>

<div class="container py-4">
    <h4 class="fw-bold text-success mb-4">Reviews & Ratings</h4>

    <ul class="nav nav-pills mb-4" id="reviewTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active rounded-pill px-4 me-2 shadow-sm" id="to-rate-tab" data-bs-toggle="pill" data-bs-target="#toRate" type="button">
                To Rate <span class="badge bg-light text-success ms-1"><?= mysqli_num_rows($toRateResult) ?></span>
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill px-4 shadow-sm" id="my-reviews-tab" data-bs-toggle="pill" data-bs-target="#myReviewsTab" type="button">
                My Reviews
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="toRate" role="tabpanel">
            <div class="row g-3">
                <?php if (mysqli_num_rows($toRateResult) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($toRateResult)): ?>
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm p-3 rounded-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?= htmlspecialchars($row['image']) ?>" style="width: 70px; height: 70px; object-fit: cover; border-radius: 12px;">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold m-0"><?= htmlspecialchars($row['tour_name']) ?></h6>
                                        <button class="btn btn-outline-success btn-sm rounded-pill mt-2 px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#rateModal<?= $row['booking_id'] ?>">Rate Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="rateModal<?= $row['booking_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-lg">
                                    <form action="api/submit_review.php" method="POST">
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold text-success">Rate Trip</h5>
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body px-4 text-center">
                                            <input type="hidden" name="tour_id" value="<?= $row['tour_id'] ?>">
                                            <div class="star-rating mb-4">
                                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                                    <input type="radio" id="s<?= $i ?>-<?= $row['booking_id'] ?>" name="rating_score" value="<?= $i ?>" required />
                                                    <label for="s<?= $i ?>-<?= $row['booking_id'] ?>"></label>
                                                <?php endfor; ?>
                                            </div>
                                            <textarea name="review_text" class="form-control border-0 bg-light rounded-4 p-3" rows="4" placeholder="How was the tour? (Optional)"></textarea>
                                        </div>
                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-muted py-5">No tours to rate.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="myReviewsTab" role="tabpanel">
            <div class="row g-3">
                <?php if (mysqli_num_rows($myReviewsResult) > 0): ?>
                    <?php while ($rev = mysqli_fetch_assoc($myReviewsResult)): ?>
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm p-3 rounded-4 h-100">
                                <div class="d-flex align-items-start gap-3">
                                    <img src="<?= htmlspecialchars($rev['image']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                                    <div>
                                        <h6 class="fw-bold m-0 text-success"><?= htmlspecialchars($rev['tour_name']) ?></h6>
                                        <div class="my-1">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi bi-star-fill <?= $i <= $rev['rating_score'] ? 'text-warning' : 'text-light' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="small text-muted mb-0 fst-italic">"<?= htmlspecialchars($rev['review_text'] ?: 'No comment.') ?>"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-muted py-5">You haven't rated any tours yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('tab') === 'myReviews') {
            const target = document.querySelector('#my-reviews-tab');
            if (target) bootstrap.Tab.getOrCreateInstance(target).show();
        }
    });
</script>