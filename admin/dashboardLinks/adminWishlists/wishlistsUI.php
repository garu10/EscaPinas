<?php
include_once("../frontend/php/connect.php");

$query = "SELECT w.*, u.first_name, u.last_name, u.email, tp.tour_name, tp.image 
          FROM wishlist w
          JOIN users u ON w.user_id = u.user_id
          JOIN tour_packages tp ON w.tour_id = tp.tour_id
          ORDER BY w.added_at DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-success mb-1">User Wishlists</h4>
            <p class="text-muted small mb-0">Overview of tours that users are currently interested in.</p>
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
                                    <th class="ps-4 py-3">Date Added</th>
                                    <th class="py-3">User</th>
                                    <th class="py-3">Tour Package</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($wish = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 small text-muted">
                                            <?= date('M d, Y', strtotime($wish['added_at'])) ?>
                                        </td>
                                        <td>
                                            <div class="fw-bold"><?= $wish['first_name'] . " " . $wish['last_name'] ?></div>
                                            <div class="small text-muted"><?= $wish['email'] ?></div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="../<?= $wish['image'] ?>" class="rounded-3" style="width: 50px; height: 35px; object-fit: cover;">
                                                <span class="fw-semibold"><?= $wish['tour_name'] ?></span>
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="dashboardLinks/adminWishlists/crud/deleteWishlist.php?id=<?= $wish['wishlist_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Remove this item from user wishlist?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No wishlist items found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>