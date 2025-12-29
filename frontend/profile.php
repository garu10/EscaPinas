<?php
session_start();

// Temporary placeholders (mapapaltan base sa DB data)
$profileImage = $_SESSION['profile_image'] ?? "assets/images/logo2.jpg";
$userName = $_SESSION['username'] ?? "EscaPinas";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body>
    <?php include "components/navbar.php"; ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="account-sidebar shadow-sm">
                    <div class="profile-image-wrapper">
                        <img src="<?= $profileImage; ?>">
                    </div>
                    <h4 class="profile-name"><?= $userName; ?></h4>
                    <a href="profile.php" class="text-center d-block text-decoration-none text-dark small">Update personal info ></a>

                    <div class="sidebar-links">
                        <a href="#"><i class="bi bi-ticket-perforated"></i> Vouchers</a>
                        <a href="tour_booking/booking.php"><i class="bi bi-book"></i> Bookings</a>
                        <a href="#"><i class="bi bi-wallet2"></i> Payment</a>
                        <a href="#"><i class="bi bi-star"></i> Reviews</a>
                        <a href="#"><i class="bi bi-gear"></i> Settings</a>
                        <a href="login.php" class="logout"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="account-details">
                    <h3 class="details-title">Personal Details</h3>
                    <p class="text-muted">Keep your details accurate for a smoother booking experience.</p>

                    <div class="mt-4">
                        <?php
                        $fields = ["First Name", "Last Name", "Address", "Email Address", "Phone Number"];
                        foreach ($fields as $idx => $field): ?>
                            <div class="mb-4 profile-row" id="row-<?= $idx ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="custom-label"><?= $field ?></label>
                                    <span class="edit-link" onclick="toggleEdit(<?= $idx ?>, true)">Edit</span>
                                </div>
                                <div class="info-box">
                                    <p class="view-text">Not set</p>
                                    <input type="text" class="custom-input" placeholder="<?= $field ?>">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn-save" onclick="openModal(<?= $idx ?>)">Save</button>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <p class="text-muted small mt-4">
                            We'll only use this info to personalize your experience on EscaPinas.
                            Your details will be stored securely using industry-standard encryption
                            and will never be made public. By saving these changes, you consent
                            to our processing of your personal data for a more streamlined booking service.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

    <div class="modal fade" id="saveConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #0ca458; font-weight: 700;">Confirm Profile Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>We've processed your profile details and they're ready to be updated!</p>
                    <p>Are you sure you have input the correct information? We want to make sure your booking experience stays smooth.</p>
                    <p class="text-muted small">Don't worry, you can always edit it again later if you change your mind.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" onclick="toggleEdit(activeIdx, false)">Review Again</button>
                    <button class="btn btn-success" id="confirmSave">Yes, Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var activeIdx = null;
        var confirmModal = new bootstrap.Modal(document.getElementById('saveConfirmModal'));

        function toggleEdit(idx, isEditing) {
            var row = document.getElementById(`row-` + idx + ``);
            if (!row) return;

            var view = row.querySelector('.view-text');
            var input = row.querySelector('.custom-input');
            var editBtn = row.querySelector('.edit-link');
            var saveBtn = row.querySelector('.btn-save');

            editBtn.style.display = isEditing ? 'none' : 'inline-block';
            saveBtn.style.display = isEditing ? 'inline-block' : 'none';
            view.style.display = isEditing ? 'none' : 'block';
            input.style.display = isEditing ? 'block' : 'none';

            if (isEditing) {
                input.value = view.textContent === "Not set" ? "" : view.textContent;
                input.focus();
                activeIdx = idx;
            }
        }

        function openModal(idx) {
            activeIdx = idx;
            confirmModal.show();
            document.getElementById('confirmSave').onclick = () => {
                var row = document.getElementById(`row-` + activeIdx + ``);
                var input = row.querySelector('.custom-input');
                row.querySelector('.view-text').textContent = input.value.trim() || "Not set";
                toggleEdit(activeIdx, false);
                confirmModal.hide();
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>