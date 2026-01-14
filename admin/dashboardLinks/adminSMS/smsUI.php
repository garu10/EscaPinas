<?php
include_once("../frontend/php/connect.php");

/** * SQL Query: Fetches SMS logs and joins with users table 
 * to show the names of recipients.
 */
$query = "SELECT s.*, u.first_name, u.last_name 
          FROM sms_logs s
          JOIN users u ON s.user_id = u.user_id
          ORDER BY s.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="../admin/adminComponents/css/smsUI.css">

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 text-start">
            <h4 class="fw-bold text-success mb-1">SMS Gateway Logs</h4>
            <p class="text-muted small mb-0">Monitor OTP deliveries, review requests, and message statuses.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-secondary small text-uppercase">
                                    <th class="ps-4 py-3">Timestamp</th>
                                    <th class="py-3">Recipient</th>
                                    <th class="py-3">Phone Number</th>
                                    <th class="py-3">Type</th>
                                    <th class="py-3">Preview</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($sms = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="small fw-bold text-dark"><?= date('M d, Y', strtotime($sms['created_at'])) ?></div>
                                                <div class="text-muted"><?= date('h:i A', strtotime($sms['created_at'])) ?></div>
                                            </td>

                                            <td class="small fw-semibold"><?= htmlspecialchars($sms['first_name'] . " " . $sms['last_name']) ?></td>

                                            <td class="small text-muted font-monospace"><?= $sms['contact_num'] ?></td>

                                            <td>
                                                <span class="badge bg-light text-dark border small fw-medium">
                                                    <?= htmlspecialchars($sms['sms_type']) ?>
                                                </span>
                                            </td>

                                            <td class="small text-muted text-truncate" style="max-width: 200px;">
                                                <?= htmlspecialchars($sms['message_content']) ?>
                                            </td>

                                            <td>
                                                <?php
                                                $status = strtolower($sms['status']);
                                                $badgeClass = 'bg-warning text-dark';
                                                if ($status == 'delivered' || $status == 'sent') $badgeClass = 'bg-success';
                                                if ($status == 'failed') $badgeClass = 'bg-danger';
                                                ?>
                                                <span class="badge rounded-pill <?= $badgeClass ?>">
                                                    <?= strtoupper($sms['status']) ?>
                                                </span>
                                            </td>

                                            <td class="pe-4 text-end">
                                                <button type="button"
                                                    class="btn btn-outline-success btn-sm rounded-circle me-1 border-0"
                                                    title="View Message"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#viewSmsModal"
                                                    data-recipient="<?= htmlspecialchars($sms['first_name'] . ' ' . $sms['last_name']) ?>"
                                                    data-content="<?= htmlspecialchars($sms['message_content']) ?>"
                                                    data-time="<?= date('M d, Y h:i A', strtotime($sms['created_at'])) ?>"
                                                    data-phone="<?= $sms['contact_num'] ?>"
                                                    data-type="<?= $sms['sms_type'] ?>"
                                                    data-status="<?= strtoupper($sms['status']) ?>">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>

                                                <a href="dashboardLinks/adminSMS/crud/deleteLog.php?id=<?= $sms['id'] ?>"
                                                    class="btn btn-outline-danger btn-sm rounded-circle border-0"
                                                    onclick="return confirm('Are you sure you want to delete this log entry?')">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-chat-left-dots text-muted d-block mb-2"></i>
                                            <span class="text-muted">No SMS logs recorded in the system.</span>
                                        </td>
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

<div class="modal fade" id="viewSmsModal" tabindex="-1" aria-labelledby="viewSmsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <div class="h5 modal-title fw-bold text-success d-flex align-items-center" id="viewSmsModalLabel">
                    <i class="bi bi-chat-text-fill me-2"></i> Message Details
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="small text-muted d-block text-uppercase fw-bold" >Recipient</label>
                        <span id="modal-recipient" class="fw-bold text-dark"></span>
                    </div>
                    <div class="col-6 text-end">
                        <label class="small text-muted d-block text-uppercase fw-bold" >Phone Number</label>
                        <span id="modal-phone" class="text-dark font-monospace"></span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label class="small text-muted d-block text-uppercase fw-bold" >Type</label>
                        <span id="modal-type" class="badge bg-light text-dark border fw-medium"></span>
                    </div>
                    <div class="col-6 text-end">
                        <label class="small text-muted d-block text-uppercase fw-bold" >Delivery Status</label>
                        <span id="modal-status" class="badge rounded-pill"></span>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border">
                    <label class="small text-muted d-block mb-2 text-uppercase fw-bold" >Full Message Content</label>
                    <div id="modal-content" class="mb-0 text-dark" ></div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div id="modal-time" class="text-muted italic"></div>
                    <button type="button" class="btn btn-success px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewSmsModal = document.getElementById('viewSmsModal');

        if (viewSmsModal) {
            viewSmsModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const recipient = button.getAttribute('data-recipient');
                const content = button.getAttribute('data-content');
                const time = button.getAttribute('data-time');
                const phone = button.getAttribute('data-phone');
                const type = button.getAttribute('data-type');
                const status = button.getAttribute('data-status');

                viewSmsModal.querySelector('#modal-recipient').textContent = recipient;
                viewSmsModal.querySelector('#modal-phone').textContent = phone;
                viewSmsModal.querySelector('#modal-content').textContent = content;
                viewSmsModal.querySelector('#modal-type').textContent = type;
                viewSmsModal.querySelector('#modal-time').textContent = 'Sent: ' + time;

                const statusBadge = viewSmsModal.querySelector('#modal-status');
                statusBadge.textContent = status;

                statusBadge.className = 'badge rounded-pill';
                if (status === 'DELIVERED' || status === 'SENT') {
                    statusBadge.classList.add('bg-success');
                } else if (status === 'FAILED') {
                    statusBadge.classList.add('bg-danger');
                } else {
                    statusBadge.classList.add('bg-warning', 'text-dark');
                }
            });
        }
    });
</script>