<?php 
$title = "| Email Management";
include 'adminComponents/head.php';
?>

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
                    <button type="button" class="btn btn-success rounded-pill px-4" onclick="prepareReply()">
                        <i class="bi bi-reply-fill me-1"></i> Reply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="composeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-success text-white border-0 rounded-top-4">
                    <h5 class="modal-title fw-bold" id="composeModalLabel">New Message</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="composeForm">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">To:</label>
                            <input type="email" id="composeTo" name="to" class="form-control rounded-3" required placeholder="recipient@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Subject:</label>
                            <input type="text" id="composeSubject" name="subject" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Message:</label>
                            <textarea id="composeMessage" name="message" class="form-control rounded-3" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="sendEmailBtn" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-send me-2"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentEmailSender = '';
        let currentEmailSubject = '';
        let currentEmailAddress = '';

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

                        row.dataset.emailId = email.id;
                        row.dataset.subject = email.subject;
                        row.dataset.from = email.from;
                        row.dataset.body = email.body;
                        row.dataset.isUnread = email.unread;
                        row.dataset.senderEmail = email.email;

                        row.onclick = function() {
                            viewEmail
                                (this.dataset.emailId,
                                    this.dataset.subject,
                                    this.dataset.from,
                                    this.dataset.body,
                                    this.dataset.isUnread,
                                    this.dataset.senderEmail
                                );
                        };

                        row.innerHTML = `
                            <td class="ps-4" style="width: 40px;"><input type="checkbox" class="form-check-input"></td>
                            <td style="width: 40px;">
                                <i id="star-${email.id}" class="bi ${email.unread ? 'bi-star-fill text-warning' : 'bi-star'}"></i>
                            </td>
                            <td style="width: 250px;">
                                <div class="fw-bold text-dark">${email.from}</div>
                                <div class="text-muted small">${email.email}</div> </td>
                            <td>${email.subject}</td>
                            <td class="text-end pe-4 text-muted small">${email.date}</td>
                        `;
                        container.appendChild(row);
                    });
                })
                .catch(err => console.error("Fetch Error:", err));
        });

        function viewEmail(id, subject, from, body, isUnread, emailAddress) {
            const modalElement = document.getElementById('viewEmailModal');

            if (!modalElement) {
                console.error("Error: Element 'viewEmailModal' not found in HTML.");
                return;
            }

            currentEmailSender = from; // Display Name (e.g., "John Doe")
            currentEmailSubject = subject;
            currentEmailAddress = emailAddress; // Raw Email (e.g., "john@gmail.com")

            document.getElementById('modalSubject').textContent = subject;
            document.getElementById('modalFrom').textContent = "From: " + from + " (" + emailAddress + ")";
            document.getElementById('modalBody').innerHTML = body;

            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
            modalInstance.show();

            if (isUnread === 'true' || isUnread === true) {
                updateEmailStatus(id);
            }
        }

        function openComposeModal() {
            document.getElementById('composeModalLabel').textContent = "New Message";
            document.getElementById('composeForm').reset();
            bootstrap.Modal.getOrCreateInstance(document.getElementById('composeModal')).show();
        }

        function prepareReply() {
            // Hide the viewer
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewEmailModal'));
            if (viewModal) viewModal.hide();

            // Set Modal to Reply Mode
            document.getElementById('composeModalLabel').textContent = "Reply to Message";

            // Directly use the raw email address we saved earlier
            document.getElementById('composeTo').value = currentEmailAddress;
            document.getElementById('composeSubject').value = "Re: " + currentEmailSubject;
            document.getElementById('composeMessage').value = "";

            // Show the Compose Modal
            const composeModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('composeModal'));
            composeModal.show();
        }

        // Send Email Handler
        // Add this inside your existing <script> section
        document.getElementById('composeForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent page reload

            const sendBtn = document.getElementById('sendEmailBtn');
            const originalBtnText = sendBtn.innerHTML;

            // Disable button and show loading state
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Sending...';

            const formData = new FormData(this);

            fetch('adminBackend/sendEmail.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Email sent successfully!');
                        // Close the modal
                        const composeModal = bootstrap.Modal.getInstance(document.getElementById('composeModal'));
                        composeModal.hide();
                        // Reset the form
                        this.reset();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while sending the email.');
                })
                .finally(() => {
                    // Restore button state
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = originalBtnText;
                });
        });

        function updateEmailStatus(id) {
            fetch('adminBackend/markAsRead.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById(`email-row-${id}`);
                        if (row) row.classList.remove('bg-light', 'fw-bold');
                    }
                });
        }

        function syncGmail() {
            fetch('adminBackend/syncEmails.php')
                .then(res => res.json())
                .then(() => location.reload());
        }
    </script>
</body>

</html>