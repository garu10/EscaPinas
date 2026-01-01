<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions | EscaPinas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="assets/css/terms.css">
</head>
<body>
    <?php include "components/navbar.php"; ?>

    <main class="container">
        
        <div class="terms-main-wrapper">
            
            <div class="terms-header-inside">
                <h1>Terms & Conditions</h1>
                <div class="title-line"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-check2-circle term-icon"></i>
                        <h4>1. Booking Agreement</h4>
                        <p>By booking with EscaPinas, you enter a formal agreement to provide accurate details. All reservations are subject to availability and verification of payment.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-credit-card term-icon"></i>
                        <h4>2. Payment Terms</h4>
                        <p>We process payments through secure gateways (GCash, PayPal). Full payment or a required deposit must be settled to finalize your tour schedule.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-clock-history term-icon"></i>
                        <h4>3. Cancellation & Refunds</h4>
                        <p>Cancellations made 7 days prior are eligible for a 50% refund. Please note that bookings cancelled within 48 hours of departure are strictly non-refundable.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-exclamation-triangle term-icon"></i>
                        <h4>4. Weather Disruptions</h4>
                        <p>EscaPinas reserves the right to reschedule or cancel trips due to coast guard advisories or extreme weather to ensure the safety of our guests.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-person-badge term-icon"></i>
                        <h4>5. Conduct & Safety</h4>
                        <p>Guests are expected to follow guide instructions. We reserve the right to exclude any participant whose behavior risks the safety or comfort of others.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-recycle term-icon"></i>
                        <h4>6. Environmental Policy</h4>
                        <p>In line with our sustainability mission, guests must adhere to "Leave No Trace" principles. Littering or disturbing wildlife is strictly prohibited.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-camera-video term-icon"></i>
                        <h4>7. Media Usage</h4>
                        <p>Photos or videos taken during tours may be used for marketing purposes. If you wish to opt-out, please notify our staff before the tour begins.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-shield-fill-check term-icon"></i>
                        <h4>8. Liability Limitation</h4>
                        <p>While we prioritize safety, EscaPinas is not responsible for personal loss or injuries resulting from third-party services or natural occurrences.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="term-card">
                        <i class="bi bi-pencil-square term-icon"></i>
                        <h4>9. Policy Updates</h4>
                        <p>These terms may be updated periodically. Your continued use of our booking services constitutes your acceptance of the revised conditions.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-lg-12">
                <div class="terms-help-box d-flex align-items-center">
                    <i class="bi bi-info-circle-fill fs-2 text-success me-4"></i>
                    <p class="mb-0 text-muted">
                        If you have questions regarding these terms, please contact our support team or use our 
                        <a href="chatbot.php" class="chatbot-btn-link"><strong>Chatbot</strong></a> for immediate assistance.
                    </p>
                </div>
            </div>
        </div>

    </main>

    <?php include "components/footer.php"; ?>
</body>
</html>