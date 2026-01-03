<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions | EscaPinas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="../../assets/css/faq.css">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <main class="container">
        <div class="faq-main-wrapper">
            
            <div class="faq-header-inside">
                <h1>Frequently Asked Questions</h1>
                <div class="title-line"></div>
                <p class="mt-3 text-muted">Find answers to common questions about your EscaPinas adventure.</p>
            </div>

            <div class="accordion accordion-flush" id="faqAccordion">
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="bi bi-question-circle me-3 text-success"></i>
                            How do I book a tour with EscaPinas?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Booking is easy! Simply browse our tour packages, select your preferred date, and fill out the booking form with accurate details. You will receive a confirmation once your payment is verified.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="bi bi-wallet2 me-3 text-success"></i>
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We accept payments through secure digital gateways including <strong>GCash</strong> and <strong>PayPal</strong>. Please ensure to settle the required deposit to secure your slot.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="bi bi-x-octagon me-3 text-success"></i>
                            What is your cancellation and refund policy?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Cancellations made at least <strong>7 days prior</strong> to the tour are eligible for a 50% refund. Unfortunately, bookings cancelled within 48 hours of departure are strictly non-refundable.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <i class="bi bi-cloud-lightning-rain me-3 text-success"></i>
                            What happens if there is bad weather?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Safety is our top priority. If there are official coast guard advisories or extreme weather conditions, EscaPinas reserves the right to reschedule or cancel the trip for your safety.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            <i class="bi bi-luggage me-3 text-success"></i>
                            What should I bring during the tour?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We recommend bringing comfortable swimwear, sun protection (sunblock/hats), a valid ID, and extra cash for personal expenses. Don't forget your camera to capture the memories!
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-12">
                <div class="faq-help-box d-flex align-items-center">
                    <i class="bi bi-chat-dots-fill fs-2 text-success me-4"></i>
                    <p class="mb-0 text-muted">
                        Need further clarification? Our support team is dedicated to your safety and comfort. 
                        Speak with our <a href="/EscaPinas/frontend/integs/chatbot/chatbotUI.php" class="chatbot-btn-link"><strong>Chatbot</strong></a> for immediate guidance.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include "../footer.php"; ?>
    
</body>
</html>