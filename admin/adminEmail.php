<?php include 'adminComponents/head.php'; ?>

    <body>
        <?php include 'adminComponents/adminNav.php'; ?>

        <div class="container-fluid px-5 py-4">
            <div class="row g-4">
                <div class="col-md-3 col-lg-2">
                    <button class="btn btn-success w-100 py-3 mb-4 shadow-sm rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#composeModal">
                        <i class="bi bi-pencil-square me-2"></i> Compose
                    </button>

                    <div class="list-group list-group-flush shadow-sm rounded-4 overflow-hidden">
                        <a href="adminEmail.php?filter=all" class="list-group-item list-group-item-action <?= (!isset($_GET['filter']) || $_GET['filter'] == 'all') ? 'active' : '' ?> border-0 py-3">
                            <i class="bi bi-inbox me-2"></i> Inbox
                        </a>
                        <a href="adminEmail.php?filter=unread" class="list-group-item list-group-item-action <?= (isset($_GET['filter']) && $_GET['filter'] == 'unread') ? 'active' : '' ?> border-0 py-3">
                            <i class="bi bi-envelope me-2"></i> Unread
                        </a>
                    </div>
                </div>

                <div class="col-md-9 col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-success m-0">Inbox</h5>
                            <div class="btn-group">
                                <button class="btn btn-light btn-sm border"><i class="bi bi-arrow-clockwise"></i></button>
                                <button class="btn btn-light btn-sm border"><i class="bi bi-three-dots-vertical"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover m-0">
                                    <tbody>
                                        <?php 
                                        $inbox_emails = include "adminBackend/fetchEmail.php"; 
                                        // Temporary Debug:
                                        // var_dump($inbox_emails);
                                        
                                        if (empty($inbox_emails)): ?>
                                            <tr><td colspan="5" class="text-center py-4 text-muted">No emails found.</td></tr>
                                        <?php else: 
                                            foreach ($inbox_emails as $email): 
                                                $row_class = $email['unread'] ? 'bg-light fw-bold' : '';
                                        ?>
                                            <tr class="<?= $row_class ?>" style="cursor: pointer;">
                                                <td class="ps-4" style="width: 40px;"><input type="checkbox" class="form-check-input"></td>
                                                <td style="width: 40px;">
                                                    <i class="bi <?= $email['unread'] ? 'bi-star-fill text-warning' : 'bi-star' ?>"></i>
                                                </td>
                                                <td style="width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <?= $email['from'] ?>
                                                </td>
                                                <td><?= $email['subject'] ?></td>
                                                <td class="text-end pe-4 text-muted small"><?= $email['date'] ?></td>
                                            </tr>
                                        <?php 
                                            endforeach; 
                                        endif; 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewEmailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <h4 id="modalSubject" class="fw-bold text-success mb-1"></h4>
                        <p id="modalFrom" class="text-muted small mb-4"></p>
                        <hr>
                        <div id="modalBody" class="mt-4" style="min-height: 200px; max-height: 400px; overflow-y: auto;">
                            </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
