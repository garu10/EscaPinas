<?php
include_once __DIR__ . "/../php/connect.php";
//include_once(__DIR__ . "/../../php/connect.php"); comment out ko muna ito para gumana sakin

$uid = $_SESSION['user_id'] ?? null;

if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to view your wishlist.</p></div>";
    return;
}
// query para makuha yung data ng wishlist ng user
$wishlistQuery = "SELECT w.wishlist_id, tp.* FROM wishlist w
                  JOIN tour_packages tp ON w.tour_id = tp.tour_id
                  WHERE w.user_id = $uid
                  ORDER BY w.added_at DESC";

$wishlistResult = executeQuery($wishlistQuery);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-success m-0">My Wishlist</h4>
    <!-- count lang toh nung current number nung wishlist -->
    <span class="badge bg-success rounded-pill"><?= mysqli_num_rows($wishlistResult) ?> Items</span>
</div>

<div class="row g-4">
    <?php if (mysqli_num_rows($wishlistResult) > 0): ?>
        <?php while ($tour = mysqli_fetch_assoc($wishlistResult)): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden wishlist-card">
                    <div class="position-relative">
                        <img src="<?= htmlspecialchars($tour['image']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Tour">
                        <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm text-danger" 
                                onclick="removeFromWishlist(<?= $tour['wishlist_id'] ?>)" title="Remove">
                            <i class="bi bi-heart-fill"></i>
                        </button>
                    </div>

                    <div class="card-body p-3">
                        <h6 class="fw-bold text-dark mb-1 text-truncate"><?= htmlspecialchars($tour['tour_name']) ?></h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-clock me-1"></i><?= $tour['duration_days'] ?>D/<?= $tour['duration_nights'] ?>N
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-success">₱<?= number_format($tour['price'], 2) ?></span>
                            <a href="packageView.php?tour_id=<?= $tour['tour_id'] ?>" class="btn btn-outline-success btn-sm px-3 rounded-pill">View</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-heart text-muted display-1"></i>
            <p class="mt-3 text-muted">Your wishlist is empty. Start exploring tours!</p>
            <a href="packages.php" class="btn btn-success rounded-pill px-4">Browse Packages</a>
        </div>
    <?php endif; ?>
</div>

<script>
function removeFromWishlist(wishlistId) {
    if(confirm('Remove this item from your wishlist?')) {
        window.location.href = `../backend/remove_wishlist.php?id=${wishlistId}`;
    }
}
</script>