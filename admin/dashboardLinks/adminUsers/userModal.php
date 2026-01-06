<div class="modal fade" id="editUser<?= $user['user_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminUsers/crud/updateUser.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Update User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control rounded-3" value="<?= $user['first_name'] ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">M.I.</label>
                            <input type="text" name="middle_initial" class="form-control rounded-3" value="<?= $user['middle_initial'] ?>" maxlength="1">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control rounded-3" value="<?= $user['last_name'] ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_num" class="form-control rounded-3" value="<?= $user['contact_num'] ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Region</label>
                            <input type="text" name="region" class="form-control rounded-3" value="<?= $user['region'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Province</label>
                            <input type="text" name="province" class="form-control rounded-3" value="<?= $user['province'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">City</label>
                            <input type="text" name="city" class="form-control rounded-3" value="<?= $user['city'] ?>">
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-success">Account Role</label>
                        <select name="role" class="form-select rounded-3">
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>Standard User</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>