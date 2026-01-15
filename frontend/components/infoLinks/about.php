<?php
$_title = "Escapinas - About Us";
session_start(); ?>

<?php include "../header.php"; ?>
<link rel="stylesheet" href="../../assets/css/about.css">

<body>
    <?php include "../navbar.php"; ?>

    <div class="container-fluid p-0">
        <div class="about-banner w-100" 
             style="background-image:url('/EscaPinas/frontend/assets/images/banner_about.gif');">
        </div>
    </div>

    <main>
        <div class="py-5 mt-md-5">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-md-6">
                        <h6 class="text-success fw-bold text-uppercase">Our Story</h6>
                        <h2 class="display-5 fw-bold mb-4">The Heart of EscaPinas</h2>
                        <div class="story-text text-muted text-start">
                            <p>It all began with a simple backpack and a deep-seated love for the Filipino landscape. In the heart of Tanauan City, EscaPinas was conceptualized not as a business, but as a movement to bridge the gap between dream destinations and reality.</p>
                            <p>We realized that many of our fellow countrymen and international friends were missing out on the raw beauty of <strong>Pilipinas</strong> due to complex bookings and intimidating costs.</p>
                            <p>Today, EscaPinas stands as more than just a booking site. We are storytellers, adventure-seekers, and your ultimate guide to the 7,641 reasons why we love our country.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
    <img src="/EscaPinas/frontend/assets/images/logo_upscaled.jpg"
         alt="EscaPinas Official Logo"
         class="img-fluid brand-logo-img main-story-logo mx-auto ms-md-5">
</div>
                </div>
            </div>
        </div>

        <div class="py-5 border-top border-bottom bg-light">
            <div class="container">
                <div class="row g-4 text-center">
                    <?php
                    $stats = [
                        ['81', 'Provinces Across Pilipinas'],
                        ['15,000+', 'Happy Explorers'],
                        ['500+', 'Local Community Partners'],
                        ['100%', 'Proudly Pinoy Founded']
                    ];
                    foreach ($stats as $stat): ?>
                    <div class="col-md-3">
                        <div class="stat-box shadow-sm">
                            <h2 class="fw-bold text-success"><?php echo $stat[0]; ?></h2>
                            <p class="mb-0 text-muted fw-semibold"><?php echo $stat[1]; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="mv-container py-5 px-4 shadow-sm">
                <div class="row g-5">
                    <div class="col-md-6 border-md-end">
                        <div class="icon-box"><i class="bi bi-flag-fill"></i></div>
                        <h3 class="fw-bold mb-3">Our Mission</h3>
                        <p class="text-muted fs-5 lh-base">To democratize travel by providing high-quality yet budget-friendly tour packages. We aim to make the wonders of the Philippines accessible to all.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-box"><i class="bi bi-compass-fill"></i></div>
                        <h3 class="fw-bold mb-3">Our Vision</h3>
                        <p class="text-muted fs-5 lh-base">To be the Philippines' leading travel technology platform that inspires people to "EscaPe" the ordinary and celebrate our heritage.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container text-center">
                <h2 class="fw-bold mb-4">Our Travel Philosophy</h2>
                <p class="text-muted mb-5">At EscaPinas, we believe that travel should be <strong>responsible, immersive, and inclusive</strong>.</p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-3">
                            <h5 class="fw-bold text-success">Authentic Experiences</h5>
                            <p class="small text-muted">We prioritize local homestays and community-led tours.</p>
                        </div>
                    </div>
                    <div class="col-md-4 border-md-start border-md-end">
                        <div class="p-3">
                            <h5 class="fw-bold text-success">Sustainability First</h5>
                            <p class="small text-muted">We promote "Leave No Trace" principles to protect our natural wonders.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <h5 class="fw-bold text-success">Radical Transparency</h5>
                            <p class="small text-muted">What you see is what you get. No hidden fees, just honest pricing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-4">Our Partnerships</h2>
            <p class="text-muted">We collaborate with trusted partners to enhance your travel experience.</p>
        </div>
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <div class="story-text text-muted text-justify ms-md-auto mx-auto mx-md-0" style="max-width: 420px;">
                    <p><strong>BookStack</strong> is our partner in literary adventures, providing access to a vast collection of books for rent. Whether you're looking to dive into Filipino literature, learn about local culture, or simply enjoy a good read during your travels, BookStack makes knowledge accessible and affordable.</p>
                </div>
            </div>
            
            <div class="col-md-6 text-center">
                <div class="mb-4">
                    <img src="/EscaPinas/frontend/assets/images/book_logo.png"
                         alt="BookStack Logo"
                         class="img-fluid brand-logo-img partner-logo-small">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="http://10.180.181.43:8080/BookStack/index.php" class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="container mb-5">
            <div class="cta-div shadow-lg text-center p-5 bg-success text-white rounded-5">
                <h2 class="display-6 fw-bold mb-3">Dito sa EscaPinas, bawat biyahe ay may kwento.</h2>
                <p class="mb-5 fs-5">Experience the magic of Pilipinas today.</p>
                <a href="../../packages.php" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-success">Explore Packages</a>
            </div>
        </div>
    </main>

    <?php include "../footer.php"; ?>
</body>
</html>