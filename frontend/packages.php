<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas | Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .btn-filter:hover { background-color: #198754; color: white; }
    </style>
</head>

<body>
    <?php include "components/navbar.php"; ?>
    <!-- separate na banner ang ginawa ko dine kasi nakalagay dun sa figma eh ibang search function na design -->
    <div class="container-fluid p-0">
        <div style="height: 400px; width: 100%; position: relative;">
            <img id="bannerImage" src="/EscaPinas/frontend/assets/images/banner.png" class="w-100 h-100" style="object-fit: cover;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            
            <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                <h1 class="text-white fw-bold display-4">Find Your Next Adventure</h1>
                <p class="text-white-50 fs-5">Explore the beauty of the Philippines with us</p>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -50px; position: relative; z-index: 10;">
        <div class="card shadow border-0 p-4">
            <form class="row g-3 align-items-end">
                <!-- binago ko lang onti yung design ng search -->
                 <!-- bale 2 cols yan, yung nasa left side parang taga select ng province -->
                <!-- sa right side, mga list yan ng attractions or tours na covered ng ating webapp -->
                 <!-- bale kusa ang mababago yung list depende sa iseselect na province ng user -->
                <div class="col-md-5 text-start">
                    <label class="form-label fw-bold text-success small">WHERE TO GO?</label>
                    <select class="form-select py-2">
                        <option selected disabled>Select Region/Province</option>
                        <optgroup label="LUZON">
                            <option value="NCR">NCR</option>
                            <option value="Ilocos">Ilocos</option>
                            <option value="Central Luzon">Central Luzon</option>
                        </optgroup>
                        <optgroup label="VISAYAS">
                            <option value="Central Visayas">Central Visayas</option>
                            <option value="Western Visayas">Western Visayas</option>
                        </optgroup>
                        <optgroup label="MINDANAO">
                            <option value="Davao">Davao Region</option>
                        </optgroup>
                    </select>
                </div>

                <div class="col-md-5 text-start">
                    <label class="form-label fw-bold text-success small">WHAT TO SEE?</label>
                    <select class="form-select py-2" id="attractionSelect" disabled>
                        <option value="">Select a location first...</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold">SEARCH</button>
                </div>
            </form>
        </div>
    </div>

   <?php include "components/offersCarousel.php"; ?>
   <!-- hinati ko na lang muna yung mga cards sa 2 sections para di masyadong plain tingnan -->
    <div class="container my-5 text-center">
        <h2 class="fw-bold text-success">Popular Attractions</h2>
        <div class="btn-group my-4 shadow-sm rounded-pill overflow-hidden">
            <button class="btn btn-success px-4">Luzon</button>
            <button class="btn btn-outline-success px-4">Visayas</button>
            <button class="btn btn-outline-success px-4">Mindanao</button>
        </div>
        <!-- test package view -->
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-start">
                    <img src="/EscaPinas/frontend/assets/images/package1.jpg" class="card-img-top rounded-top-4" height="250" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold">Baguio and Sagada Tour Package</h5>
                        <p class="text-muted small">Luzon | CALABARZON</p>
                        <a href="packageView.php" class="btn btn-link text-success p-0 fw-bold text-decoration-none">View Details <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-start">
                    <img src="/EscaPinas/frontend/assets/images/package2.jpg" class="card-img-top rounded-top-4" height="250" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold">Tagaytay Ridge</h5>
                        <p class="text-muted small">Luzon | CALABARZON</p>
                        <a href="#" class="btn btn-link text-success p-0 fw-bold text-decoration-none">View Details <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-start">
                    <img src="/EscaPinas/frontend/assets/images/package3.jpg" class="card-img-top rounded-top-4" height="250" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold">Tagaytay Ridge</h5>
                        <p class="text-muted small">Luzon | CALABARZON</p>
                        <a href="#" class="btn btn-link text-success p-0 fw-bold text-decoration-none">View Details <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- naglagay ako ng filters dito na baka pwede -->
     <!-- kung di approve pwede naman alisin -->
    <div class="container my-5 text-center">
        <h2 class="fw-bold text-success">Unique Experiences</h2>
        <div class="d-flex flex-wrap justify-content-center gap-2 my-4">
            <button class="btn btn-success rounded-pill px-4">Best Things To Do</button>
            <button class="btn btn-outline-success rounded-pill px-4">Night Attractions</button>
            <button class="btn btn-outline-success rounded-pill px-4">Family Friendly</button>
            <button class="btn btn-outline-success rounded-pill px-4">Activities</button>
        </div>

        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm">
                    <img src="/EscaPinas/frontend/assets/images/package1.jpg" class="card-img-top" height="150" style="object-fit: cover;">
                    <div class="card-body p-2">
                        <p class="fw-bold mb-0">Kayaking in Palawan</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm">
                    <img src="/EscaPinas/frontend/assets/images/package2.jpg" class="card-img-top" height="150" style="object-fit: cover;">
                    <div class="card-body p-2">
                        <p class="fw-bold mb-0">Kayaking in Palawan</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm">
                    <img src="/EscaPinas/frontend/assets/images/package3.jpg" class="card-img-top" height="150" style="object-fit: cover;">
                    <div class="card-body p-2">
                        <p class="fw-bold mb-0">Kayaking in Palawan</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm">
                    <img src="/EscaPinas/frontend/assets/images/package1.jpg" class="card-img-top" height="150" style="object-fit: cover;">
                    <div class="card-body p-2">
                        <p class="fw-bold mb-0">Kayaking in Palawan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>