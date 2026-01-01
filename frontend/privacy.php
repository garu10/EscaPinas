<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | EscaPinas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="assets/css/privacy.css">
</head>
<body>
    <?php include "components/navbar.php"; ?>

    <main class="container">
        <div class="privacy-main-wrapper">
            
            <div class="privacy-header-inside">
                <h1>Privacy Policy</h1>
                <div class="title-line"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-database-add policy-icon"></i>
                        <h4>1. Information Collection</h4>
                        <p>We collect personal data such as your name, email, and contact number when you book a tour or register an account with us.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-eye-slash policy-icon"></i>
                        <h4>2. How We Use Data</h4>
                        <p>Your information is used solely to process bookings, verify payments, and send important travel updates regarding your tour.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-cookie policy-icon"></i>
                        <h4>3. Cookies & Tracking</h4>
                        <p>We use cookies to enhance your browsing experience and analyze site traffic. You can manage cookie preferences through your browser settings.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-shield-lock policy-icon"></i>
                        <h4>4. Data Security</h4>
                        <p>We implement industry-standard encryption to protect your personal data from unauthorized access, disclosure, or alteration.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-share policy-icon"></i>
                        <h4>5. Third-Party Sharing</h4>
                        <p>We do not sell your data. We only share necessary details with payment gateways (GCash, PayPal) and local tour operators to fulfill your booking.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="policy-card">
                        <i class="bi bi-person-gear policy-icon"></i>
                        <h4>6. Your Rights</h4>
                        <p>You have the right to access, update, or request the deletion of your personal information at any time by contacting our support.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-12">
                <div class="privacy-help-box d-flex align-items-center">
                    <i class="bi bi-shield-check fs-2 text-success me-4"></i>
                    <p class="mb-0 text-muted">
                        Your privacy is our priority. If you have concerns about your data, please contact our Data Protection Officer or use our 
                        <a href="chatbot.php" class="chatbot-btn-link"><strong>Chatbot</strong></a>.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>