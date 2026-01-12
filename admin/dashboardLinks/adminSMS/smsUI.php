<?php
include_once("../frontend/php/connect.php");

$query = "SELECT s.*, u.first_name, u.last_name 
          FROM sms_logs s
          JOIN users u ON s.user_id = u.user_id
          ORDER BY s.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
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
                                <tr class="text-secondary small">
                                    <th class="ps-4 py-3">Timestamp</th>
                                    <th class="py-3">Recipient</th>
                                    <th class="py-3">Phone Number</th>
                                    <th class="py-3">Type</th>
                                    <th class="py-3" style="width: 30%;">Message Content</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($sms = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 small">
                                            <div class="fw-bold"><?= date('M d, Y', strtotime($sms['created_at'])) ?></div>
                                            <div class="text-muted italic" style="font-size: 0.75rem;"><?= date('h:i A', strtotime($sms['created_at'])) ?></div>
                                        </td>
                                        
                                        <td><?= htmlspecialchars($sms['first_name'] . " " . $sms['last_name']) ?></td>
                                        
                                        <td class="small fw-bold"><?= $sms['contact_num'] ?></td>
                                        
                                        <td>
                                            <span class="badge bg-light text-dark border small">
                                                <?= $sms['sms_type'] ?>
                                            </span>
                                        </td>
                                        
                                        <td class="small text-muted text-truncate" style="max-width: 250px;">
                                            <?= htmlspecialchars($sms['message_content']) ?>
                                        </td>
                                        
                                        <td>
                                            <?php 
                                                $status = strtolower($sms['status']);
                                                $badgeClass = 'bg-warning'; // pending
                                                if($status == 'delivered' || $status == 'sent') $badgeClass = 'bg-success';
                                                if($status == 'failed') $badgeClass = 'bg-danger';
                                            ?>
                                            <span class="badge rounded-pill <?= $badgeClass ?>">
                                                <?= strtoupper($sms['status']) ?>
                                            </span>
                                        </td>
                                        
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    title="View Message"
                                                    onclick="alert('Full Message: <?= addslashes($sms['message_content']) ?>')">
                                                <i class="bi bi-eye text-primary"></i>
                                            </button>
                                            
                                            <a href="dashboardLinks/adminSMS/crud/deleteLog.php?id=<?= $sms['id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete this log entry?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center py-5 text-muted">No SMS logs found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>