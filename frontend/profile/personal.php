<?php
include_once(__DIR__ . "/../php/connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: /EscaPinas/frontend/login.php");
    exit();
}

$uid = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = '$uid'";
$result = executeQuery($query);
$user = mysqli_fetch_assoc($result);

// labels toh tsaka yung corresponsing values
// kaya dun sa foreach na loop may $label at $val (value yon)
$fields = [
    "First Name"    => $user['first_name'] ?? '',
    "Last Name"     => $user['last_name'] ?? '',
    "Address"       => $user['province'] ?? '',
    "Email Address" => $user['email'] ?? '',
    "Phone Number"  => $user['contact_num'] ?? ''
];
?>
<h3 class="fw-bold text-success">Personal Details</h3>
<p class="text-muted small">Keep your details accurate for a smoother booking experience.</p>

<div class="mt-4">
    <!-- nandito pa rin yung code at logic, may binago lang ako sa fields/labels at yung laman ng p tag -->
    <?php 
    $idx = 0;
    foreach ($fields as $label => $val): ?>
        <div class="mb-4 profile-row" id="row-<?= $idx ?>">
            <div class="d-flex justify-content-between align-items-center">
                <label class="fw-semibold text-success small"><?= $label ?></label>
                <span class="edit-link text-primary fw-bold" onclick="toggleEdit(<?= $idx ?>, true)" style="font-size: 13px; cursor: pointer;">Edit</span>
            </div>
            <div class="info-box" style="background: #edededff; border-radius: 12px; padding: 12px 15px; min-height: 48px; display: flex; align-items: center; margin-top: 5px;">
                <p class="view-text m-0 fw-semibold text-dark w-100"><?= !empty($val) ? htmlspecialchars($val) : "Not set"; ?></p>
                <input type="text" class="custom-input w-100 fw-semibold text-dark" placeholder="<?= $field ?>"
                    style="background: transparent; border: none; padding: 0; display: none; outline: none;">
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-success btn-save mt-2 px-4 fw-bold" onclick="openModal(<?= $idx ?>)"
                    style="border-radius: 10px; display: none; font-size: 14px;">Save</button>
            </div>
        </div>
    <?php 
    $idx++;
    endforeach; ?>

    <p class="text-muted small mt-4">
        We'll only use this info to personalize your experience on EscaPinas.
        Your details will be stored securely using industry-standard encryption
        and will never be made public. By saving these changes, you consent
        to our processing of your personal data for a more streamlined booking service.
    </p>
</div>

<div class="modal fade" id="saveConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-success">Confirm Profile Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We've processed your profile details and they're ready to be updated!</p>
                <p>Are you sure you have input the correct information? We want to make sure your booking experience stays smooth.</p>
                <p class="text-muted small">Don't worry, you can always edit it again later if you change your mind.</p>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary rounded-3" data-bs-dismiss="modal" onclick="toggleEdit(activeIdx, false)">Review Again</button>
                <button class="btn btn-success rounded-3 px-4" id="confirmSave">Yes, Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var activeIdx = null;
    var confirmModal = new bootstrap.Modal(document.getElementById('saveConfirmModal'));

    function toggleEdit(idx, isEditing) {
        var row = document.getElementById('row-' + idx);
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
            input.value = (view.textContent === "Not set") ? "" : view.textContent;
            input.focus();
            activeIdx = idx;
        }
    }

    function openModal(idx) {
        activeIdx = idx;
        confirmModal.show();

        document.getElementById('confirmSave').onclick = function() {
            var row = document.getElementById('row-' + activeIdx);
            var input = row.querySelector('.custom-input');
            var view = row.querySelector('.view-text');

            if (input.value.trim() !== "") {
                view.textContent = input.value.trim();
            } else {
                view.textContent = "Not set";
            }

            toggleEdit(activeIdx, false);
            confirmModal.hide();
        };
    }
</script>