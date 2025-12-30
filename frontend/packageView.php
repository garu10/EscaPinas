<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EscaPinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include "components/navbar.php"; ?>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <a href="javascript:history.back()" class="btn btn-light btn-sm position-absolute rounded-pill shadow-sm px-3 py-2" style="top: 20px; left: 20px; z-index: 1050; opacity: 0.9;"><i class="bi bi-chevron-left"></i> Back</a>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 50vh; min-height: 300px;">
                            <img src="assets/images/banner.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="...">
                        </div>
                        <div class="carousel-item" style="height: 50vh; min-height: 300px;">
                            <img src="assets/images/banner.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="...">
                        </div>
                        <div class="carousel-item" style="height: 50vh; min-height: 300px;">
                            <img src="assets/images/banner.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
   <div class="container my-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow p-5 rounded-5">
                    <div class="mb-2">
                        <h1 class="fw-bold text-success mb-2">₱ 12,500 <small class="fw-bold text-muted fs-6 fw-normal">/ PAX</small></h1>
                        <div class="text-warning fs-6">
                            <span class="text-success small ms-2">4.9 RATING</span>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h1 class="fw-bold text-success mb-3">Baguio and Sagada Tour Package</h1>
                        <p class="text-secondary leading-relaxed">
                            Enjoy a cool and scenic North Luzon getaway with this Baguio and Sagada 
                            tour package. Visit Baguio’s top attractions such as Camp John Hay, Mines 
                            View Park, The Mansion, Wright Park, and Botanical Garden, then head to 
                            Sagada to explore the Hanging Coffins, Echo Valley, Sumaguing Cave, Bomod-ok 
                            Falls, and breathtaking sunrise viewpoints. This package offers a perfect 
                            blend of nature, culture, and relaxation for a memorable mountain escape.
                        </p>
                    </div>
                    <div class="row mb-5 justify-content-start g-2">
                        <div class="col-auto d-flex align-items-center gap-2 px-3">
                            <i class="bi bi-moon-stars text-success fs-6"></i>
                            <span class="fw-bold">2D - 1N</span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-calendar-range text-success fs-6"></i>
                            <span class="fw-bold">JAN 1 - 2</span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-bus-front text-success fs-6"></i>
                            <span class="fw-bold">CAR</span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-people text-success fs-6"></i>
                            <span class="fw-bold">Max 10 PAX</span>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 position-relative mb-5" style="height: 600px; background: url('/EscaPinas/frontend/assets/images/banner.png') center/cover no-repeat;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center mb-5 text-white">Places to Visit</h1>
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators" style="bottom: -50px;">
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row g-4">
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package1.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Mines View Park</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package2.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Wright Park</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package3.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Hangging Coffins</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row g-4">
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package1.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Mines View Park</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package2.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Wright Park</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="assets/images/package3.jpg" class="card-img rounded-3" style="height: 300px; object-fit: cover;" >
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0">Hangging Coffins</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" style="left: -100px;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="right: -100px;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            <p class="text-center text-white">Discover breathtaking destinations handpicked by Escapinas. From iconic tourist spots to hidden gems,</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h3 class="fw-bold text-success mb-4">Tour Details & Information</h3>
                <div class="accordion shadow-sm" id="accordionExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="bi bi-map-fill me-2 text-success"></i> Itinerary
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Day 1: Day 1: Travel to Baguio</strong></li>
                                    <li class="mb-2">Arrival & Check-in at Baguio Hotel (Breakfast Included)</li>
                                        <ul>
                                            <li class="mb-2">Visit Lion’s Head </li>
                                            <li class="mb-2">Sidetrip to Camp John Hay </li>
                                            <li class="mb-2">Sidetrip to  Mines View Park</li>
                                            <li class="mb-2">Sidetrip to  Botanical Garden</li>
                                        </ul>
                                    <li class="mb-2"><strong>Day 2: Travel to Sagada</strong></li>
                                    <li>Sunrise at Marlboro Hills </li>
                                        <ul>
                                            <li class="mb-2">Breakfast (on your own account) </li>
                                        </ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-geo-alt-fill me-2 text-success"></i> Pick Up & Drop Off
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Location Points</strong></li>
                                    <li class="mb-2"><strong>Luzon</strong></li>
                                        <ul>
                                            <li class="mb-2">Designated pickup points include Metro Manila
                                                 (Cubao, Pasay, Makati) and other agreed meetup locations 
                                                 within Luzon. Final pickup details will be provided upon booking.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Visayas</strong></li>
                                        <ul>
                                            <li class="mb-2">Designated pickup points include Cebu City, 
                                                Iloilo City, and Bacolod City, with exact locations confirmed after booking.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Mindanao</strong></li>
                                        <ul>
                                            <li class="mb-2"> Pickup and drop-off will be at the designated airport, 
                                                such as NAIA (Manila), Mactan–Cebu International Airport, or Davao 
                                                International Airport, depending on the tour.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Tours Requiring AirTravels</strong></li>
                                        <ul>
                                            <li class="mb-2"> Pickup and drop-off will be at the designated 
                                                airport, such as NAIA (Manila), Mactan–Cebu International 
                                                Airport, or Davao International Airport, depending on the tour.</li>
                                        </ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-check-circle-fill me-2 text-success"></i> Inclusions & Exclusions
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-success">Inclusions:</h6>
                                        <ul class="small">
                                            <li>Comfortable accommodations in Baguio and Sagada</li>
                                            <li>Daily breakfast at the hotel</li>
                                            <li>Guided city and sightseeing tours in Baguio and Sagada</li>
                                            <li>Transportation for all included tours</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-danger">Exclusions:</h6>
                                        <ul class="small">
                                            <li>Meals not mentioned in the package</li>
                                            <li>Optional activities or add-on tours</li>
                                            <li>Environmental fees not stated in inclusions</li>
                                            <li>Personal expenses and gratuities</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-backpack-fill me-2 text-success"></i> Things to Bring
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="d-flex flex-wrap gap-3">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><strong>Pack smart for city strolls and mountain adventures—comfort and safety first!</strong></li>
                                            <ul>
                                                <li class="mb-2">Valid ID</li>
                                                <li class="mb-2">Booking confirmation / voucher</li>
                                                <li class="mb-2">Comfortable clothes (light for city, warm layers for Sagada) Walking / hiking shoes</li>
                                                <li class="mb-2">Jacket / raincoat</li>
                                                <li class="mb-2">Water bottle / hydration pack</li>
                                                <li class="mb-2">Snacks / trail food</li>
                                                <li class="mb-2">Sunscreen & insect repellent</li>
                                                <li class="mb-2">Cap / hat</li>
                                                <li class="mb-2">Personal medications & toiletries</li>
                                            </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <i class="bi bi-info-circle-fill me-2 text-success"></i> About the Tour
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                        <li class="mb-2"><strong>Baguio and Sagada Adventure</strong></li>
                                            <ul>
                                                <li class="mb-2">Explore the cool, scenic beauty of Baguio 
                                                    and the serene mountains of Sagada on this unforgettable 
                                                    tour. Stroll through vibrant city streets, visit local 
                                                    markets, and enjoy the crisp mountain air. Discover hidden 
                                                    gems like Sagada’s hanging coffins, caves, and breathtaking 
                                                    viewpoints. Perfect for adventure seekers and nature lovers
                                                     alike, this tour combines culture, history, and stunning 
                                                     landscapes. Create lasting memories while experiencing the 
                                                     best of northern Philippines.</li>
                                            </ul>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center justify-content-center mb-5">
            <div class="col-10">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-success px-5 btn-lg py-3 fw-bold rounded-pill">Book This Trip</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-secondary px-5 btn-lg py-3 fw-bold rounded-pill">Add to Wishlist</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <?php include "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>

</html>
