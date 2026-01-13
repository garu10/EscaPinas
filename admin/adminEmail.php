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
                    <button id="syncBtn" class="btn btn-light btn-sm border" onclick="syncGmail()">
                        <i class="bi bi-arrow-clockwise"></i> Sync Gmail
                    </button>
                </div>
            </div>

            <div class="col-md-9 col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-success m-0">Inbox</h5>
                        <div class="btn-group">
                            <button class="btn btn-light btn-sm border" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover m-0">
                                <tbody id="emailTableBody">
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="spinner-border text-success" role="status"></div>
                                            <p class="mt-2 text-muted">Fetching your emails, please wait...</p>
                                        </td>
                                    </tr>
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
                    <div id="modalBody" class="mt-4" style="min-height: 200px; max-height: 400px; overflow-y: auto;"></div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filter = new URLSearchParams(window.location.search).get('filter') || 'all';
            const container = document.getElementById('emailTableBody');
            
            fetch(`adminBackend/ajaxFetchEmails.php?filter=${filter}`)
                .then(response => response.json())
                .then(data => {
                    if (!data || data.length === 0) {
                        container.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No emails found.</td></tr>';
                        return;
                    }

                    container.innerHTML = ''; 
                    data.forEach(email => {
                        const row = document.createElement('tr');
                        row.id = `email-row-${email.id}`;
                        if (email.unread) row.classList.add('bg-light', 'fw-bold');
                        row.style.cursor = 'pointer';
                        
                        // Attach the data directly to the row element to avoid quote issues
                        row.dataset.emailId = email.id;
                        row.dataset.subject = email.subject;
                        row.dataset.from = email.from;
                        row.dataset.body = email.body;
                        row.dataset.isUnread = email.unread;

                        row.onclick = function() {
                            viewEmail(this.dataset.emailId, this.dataset.subject, this.dataset.from, this.dataset.body, this.dataset.isUnread === 'true');
                        };

                        row.innerHTML = `
                            <td class="ps-4" style="width: 40px;"><input type="checkbox" class="form-check-input"></td>
                            <td style="width: 40px;">
                                <i id="star-${email.id}" class="bi ${email.unread ? 'bi-star-fill text-warning' : 'bi-star'}"></i>
                            </td>
                            <td style="width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                ${email.from}
                            </td>
                            <td>${email.subject}</td>
                            <td class="text-end pe-4 text-muted small">${email.date}</td>
                        `;
                        container.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    container.innerHTML = '<tr><td colspan="5" class="text-center text-danger py-4">Error loading emails.</td></tr>';
                });
        });

        function viewEmail(id, subject, from, body, isUnread) {
            try {
                // 1. Fill Modal Content
                document.getElementById('modalSubject').textContent = subject;
                document.getElementById('modalFrom').textContent = "From: " + from;
                
                // Using an iframe or sandboxed div is safer for HTML emails, 
                // but for now, we'll ensure the content is injected safely
                document.getElementById('modalBody').innerHTML = body;
                
                // 2. Trigger Bootstrap Modal
                // We use the bootstrap global object. Ensure bootstrap.bundle.min.js is loaded!
                const modalElement = document.getElementById('viewEmailModal');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.show();

                // 3. Logic to update "Unread" status
                if (isUnread) {
                    updateEmailStatus(id);
                }
            } catch (err) {
                console.error("Modal Error:", err);
                alert("Could not open email. Check browser console.");
            }
        }

        function updateEmailStatus(id) {
            fetch('adminBackend/markAsRead.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById(`email-row-${id}`);
                    const star = document.getElementById(`star-${id}`);
                    if (row) row.classList.remove('bg-light', 'fw-bold');
                    if (star) {
                        star.classList.remove('bi-star-fill', 'text-warning');
                        star.classList.add('bi-star');
                    }
                }
            })
            .catch(err => console.error("Mark Read Error:", err));
        }
        function syncGmail() {
            const btn = document.getElementById('syncBtn');
            const icon = btn.querySelector('i');
            btn.disabled = true;
            icon.classList.add('bi-spin'); // Optional CSS spinning

            fetch('adminBackend/syncEmails.php')
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        location.reload(); // Reload to show new emails from DB
                    } else {
                        alert("Sync Error: " + data.error);
                        btn.disabled = false;
                    }
                });
        }
    </script>
</body>
</html>