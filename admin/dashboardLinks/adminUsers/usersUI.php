<?php
include_once("../frontend/php/connect.php");

$query = "SELECT * FROM users ORDER BY user_id DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">User Management</h4>
                <p class="text-muted small mb-0">Manage system access and user roles.</p>
            </div>
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
                                    <th class="ps-4 py-3">ID</th>
                                    <th class="py-3">Full Name</th>
                                    <th class="py-3">Email & Contact</th>
                                    <th class="py-3">Location</th>
                                    <th class="py-3">Role</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($user = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 text-muted">#<?= $user['user_id'] ?></td>
                                        <td>
                                            <span class="fw-bold text-dark">
                                                <?= $user['first_name'] . " " . ($user['middle_initial'] ? $user['middle_initial'] . ". " : "") . $user['last_name'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small"><?= $user['email'] ?></div>
                                            <div class="text-muted small"><?= $user['contact_num'] ?></div>
                                        </td>
                                        <td class="small">
                                            <?= $user['city'] ?>, <?= $user['province'] ?>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill <?= $user['role'] == 'admin' ? 'bg-primary' : 'bg-secondary' ?>">
                                                <?= ucfirst($user['role']) ?>
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editUser<?= $user['user_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminUsers/crud/deleteUser.php?id=<?= $user['user_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Remove this user permanently?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php include 'userModal.php'; ?>
                                    
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">No users found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>