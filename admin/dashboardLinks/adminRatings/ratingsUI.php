<?php
include_once("../frontend/php/connect.php");

$query = "SELECT r.*, u.first_name, u.last_name, tp.tour_name 
          FROM ratings r
          JOIN users u ON r.user_id = u.user_id
          JOIN tour_packages tp ON r.tour_id = tp.tour_id
          ORDER BY r.review_id DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-success mb-1">Reviews & Ratings</h4>
            <p class="text-muted small mb-0">Monitor and manage customer feedback for tour packages.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-secondary small">
                                    <th class="ps-4 py-3">User</th>
                                    <th class="py-3">Tour Package</th>
                                    <th class="py-3">Score</th>
                                    <th class="py-3">Review</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($rev = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold"><?= $rev['first_name'] . " " . $rev['last_name'] ?></span>
                                        </td>
                                        <td><?= $rev['tour_name'] ?></td>
                                        <td>
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <i class="bi bi-star-fill <?= $i <= $rev['rating_score'] ? 'text-warning' : 'text-light' ?>" style="font-size: 0.8rem;"></i>
                                            <?php endfor; ?>
                                        </td>
                                        <td>
                                            <small class="text-muted d-inline-block text-truncate" style="max-width: 250px;">
                                                "<?= $rev['review_text'] ?>"
                                            </small>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editReview<?= $rev['review_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminRatings/crud/deleteReview.php?id=<?= $rev['review_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Permanently delete this review?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editReviewModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No reviews yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-warning { color: #ffc107 !important; }
    .text-light { color: #e9ecef !important; }
</style>