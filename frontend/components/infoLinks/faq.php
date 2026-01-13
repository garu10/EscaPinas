<?php
$_title = "Escapinas - Frequently Asked Questions";
session_start(); ?>

<?php include "../header.php"; ?>
<link rel="stylesheet" href="../../assets/css/faq.css">

<body>
    <?php include "../navbar.php"; ?>

    <div class="container my-5">
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
                            We accept payments through <strong>card</strong> and secure a digital gateway, <strong>PayPal</strong>. Please ensure to settle the required deposit to secure your slot.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="bi bi-x-octagon me-3 text-success"></i>
                            Can I cancel my tour and get a refund?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            EscaPinas operates under a strict <strong>No-Cancellation</strong> and <strong>No-Refund policy</strong>. Once a booking is confirmed and payment is processed, all slots are considered final and non-refundable. However, you can contact the EscaPinas through our email or number to discuss possible rescheduling options.
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
                            Safety is our top priority. If there are official coast guard advisories or extreme weather conditions, EscaPinas reserves the right to reschedule the trip for your safety.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            <i class="bi bi-airplane-engines me-3 text-success"></i>
                            Do you handle airline bookings?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            While we provide the flight details, airfare is often managed through external providers. We provide all necessary documentation so you can check your status directly with the airline.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            <i class="bi bi-luggage me-3 text-success"></i>
                            What should I bring during the tour?
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
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
    </div>

    <?php include "../footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>