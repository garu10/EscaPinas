<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .about-header {
            background: linear-gradient(rgba(12, 164, 88, 0.8), rgba(12, 164, 88, 0.8)), url('frontend/assets/images/banner.png');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .mission-vision { border-left: 5px solid #0CA458; padding-left: 20px; }
    </style>
</head>
<body>

    <?php include "components/navbar.php"; ?>

    <header class="about-header">
        <div class="container">
            <h1 class="display-4 fw-bold">About EscaPinas</h1>
            <p class="lead">Your gateway to affordable and unforgettable Philippine adventures.</p>
        </div>
    </header>

    <div class="container my-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold text-success">Who We Are</h2>
                <p>EscaPinas is a dedicated travel platform that aims to showcase the hidden gems of the Philippines. From the white sands of Palawan to the historic streets of Vigan, we make travel accessible for everyone.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="frontend/assets/images/logo2.jpg" alt="EscaPinas Logo" class="img-fluid rounded-4 shadow" style="max-height: 300px;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm mission-vision h-100">
                    <h4 class="fw-bold text-success">Our Mission</h4>
                    <p>To provide budget-friendly and high-quality tour packages that allow travelers to explore the Philippines without breaking the bank.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm mission-vision h-100">
                    <h4 class="fw-bold text-success">Our Vision</h4>
                    <p>To become the leading travel companion for every Filipino and international tourist seeking authentic local experiences.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

</body>
</html>