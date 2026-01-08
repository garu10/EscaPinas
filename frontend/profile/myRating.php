<?php
include_once(__DIR__ . "/../../php/connect.php");

$uid = $_SESSION['user_id'] ?? null;
if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to manage reviews.</p></div>";
    return;
}

$today = date('Y-m-d');

// ito yung mga lalabas lang sa to rate na tab
// kukunin lang dito yung if yung end_date ng nabooked na tour is lagpas na sa current date
// then dat hindi pa siya nar-review nung user and dat confirmed na rin yung booking_status niya
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

// sineselect lang lahat ng reviews dito
$myReviewsQuery = "SELECT r.*, tp.tour_name, tp.image 
                   FROM ratings r
                   JOIN tour_packages tp ON r.tour_id = tp.tour_id
                   WHERE r.user_id = $uid
                   ORDER BY r.review_id DESC";
$myReviewsResult = executeQuery($myReviewsQuery);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-success m-0">Reviews & Ratings</h4>
</div>
<!-- ito yung dalwang tabs  -->
<ul class="nav nav-pills mb-4" id="reviewTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active shadow-sm rounded-pill px-4 me-2" id="to-rate-tab" data-bs-toggle="pill" data-bs-target="#toRate" type="button">
            To Rate <span class="badge bg-success ms-1"><?= mysqli_num_rows($toRateResult) ?></span>
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link shadow-sm rounded-pill px-4" id="my-reviews-tab" data-bs-toggle="pill" data-bs-target="#myReviewsTab" type="button">
            My Reviews
        </button>
    </li>
</ul>

<div class="tab-content">
    <div class="container">
        <div class="row">
            <div class="col">
                
            </div>
        </div>
    </div>
    <div class="tab-pane fade show active" id="toRate" role="tabpanel">
        <div class="row g-3">
            <?php if (mysqli_num_rows($toRateResult) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($toRateResult)): ?>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-3 rounded-4 mb-2"> <div class="d-flex align-items-center gap-3">
                                <img src="<?= $row['image'] ?>" class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1"><?= $row['tour_name'] ?></h6>
                                    <p class="text-muted small mb-2">Completed on <?= date('M d, Y', strtotime($row['end_date'])) ?></p>
                                    <button class="btn btn-outline-success btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#rateModal<?= $row['tour_id'] ?>">
                                        Rate Now
                                    </button> </div> </div> </div> <div class="modal fade" id="rateModal<?= $row['tour_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4">
                                    <form action="profile/api/submit_review.php" method="POST">
                                        <div class="modal-header border-0">
                                            <h5 class="fw-bold">Rate: <?= $row['tour_name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <input type="hidden" name="tour_id" value="<?= $row['tour_id'] ?>">
                                            <div class="star-rating mb-3">
                                                <?php for($i=5; $i>=1; $i--): ?>
                                                    <input type="radio" id="star<?= $i ?>_<?= $row['tour_id'] ?>" name="rating_score" value="<?= $i ?>" required />
                                                    <label for="star<?= $i ?>_<?= $row['tour_id'] ?>"><i class="bi bi-star-fill"></i></label>
                                                <?php endfor; ?>
                                            </div>
                                            <textarea name="review_text" class="form-control rounded-3" rows="4" placeholder="Share your experience..." required></textarea>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit" class="btn btn-success w-100 rounded-pill">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5 text-muted">No tours waiting to be rated.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="tab-pane fade" id="myReviewsTab" role="tabpanel">
        <div class="row g-3">
            <?php if (mysqli_num_rows($myReviewsResult) > 0): ?>
                <?php while ($rev = mysqli_fetch_assoc($myReviewsResult)): ?>
                    <div class="col-md-6">
                        <div class="review-box card h-100 shadow-sm border-0">
                            <img src="<?= $rev['image'] ?>" class="review-img-top" alt="Tour">
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-success mb-1"><?= strtoupper($rev['tour_name']) ?></h6>
                                <div class="mb-2">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <i class="bi bi-star-fill <?= $i <= $rev['rating_score'] ? 'text-warning' : 'text-light' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="small text-dark mb-0 italic">"<?= $rev['review_text'] ?>"</p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5 text-muted">You haven't written any reviews yet.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .star-rating { display: flex; flex-direction: row-reverse; justify-content: center; gap: 10px; }
    .star-rating input { display: none; }
    .star-rating label { cursor: pointer; font-size: 2rem; color: #e9ecef; transition: 0.2s; }
    .star-rating input:checked ~ label, .star-rating label:hover, .star-rating label:hover ~ label { color: #ffc107; }
    .review-box { border-bottom: 4px solid #1aa866 !important; border-radius: 15px; overflow: hidden; }
    .review-img-top { height: 120px; object-fit: cover; }
    .text-warning { color: #ffc107 !important; }
</style>