<!doctype html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">    </head>

    <body>
        <?php include "frontend/components/navbar.php"; ?>
        <?php include "frontend/banner.php"; ?>

        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <h5 class="mt-3" style="font-size:20px; color:#053207;">Your Next Escape Starts Here!</h5>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-6">
                    <h2 class="mb-2" style="font-size:50px; font-weight:bold; color:#053207;">EscaPinas' Top Choices</h2>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <h5 class="mb-2" style="font-size:16px; color:#053207;">
                        <a href="packages.php" class="text-decoration-none" style="color:#0CA458;"> View All Packages <i class="bi bi-arrow-right"></i></a>
                    </h5>
                </div>
            </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-2" style="border-radius: 20px; background-color:#A5D6A7;">
                    <img src="frontend/assets/images/package1.jpg"  class="card-img-top p-3 rounded-5 shadow" style="height:300px; object-fit: cover; border-radius: 50px;" >
                    <div class="card-body">
                    <h5 class="mb-2" style="font-size:30px;">Tagaytay | Luzon</h5>
                    <p class="mb-1" style="font-size:20px;">A relaxing getaway with breathtaking views of Taal Volcano.</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success">Starts at</span>
                        <p class="fw-bold text-dark mb-0" style="font-size:35px;">₱999.00<span class="fs-6 ms-2">/per pax</span></p>
                    </div>
                    <a href="#" class="btn btn-success w-100 mt-2">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-2" style="border-radius: 20px; background-color:#A5D6A7;">
                    <img src="frontend/assets/images/package2.jpg"  class="card-img-top p-3 rounded-5 shadow" style="height:300px; object-fit: cover; border-radius: 50px;" >
                    <div class="card-body">
                    <h5 class="mb-2" style="font-size:30px;">Bohol | Visayas</h5>
                    <p class="mb-1" style="font-size:20px;">Enjoy the view of the Chocolate Hills and explore tourists spots.</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success">Starts at</span>
                        <p class="fw-bold text-dark mb-0" style="font-size:35px;">₱2,999.00<span class="fs-6 ms-2">/per pax</span></p>
                    </div>
                    <a href="#" class="btn btn-success w-100 mt-2">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-2" style="border-radius: 20px; background-color:#A5D6A7;">
                    <img src="frontend/assets/images/package3.jpg"  class="card-img-top p-3 rounded-5 shadow" style="height:300px; object-fit: cover; border-radius: 50px;" >
                    <div class="card-body">
                    <h5 class="mb-2" style="font-size:30px;">Siargao | Mindano</h5>
                    <p class="mb-1" style="font-size:20px;">Dive into different seas, rivers, and hike in mountains.</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success">Starts at</span>
                        <p class="fw-bold text-dark mb-0" style="font-size:35px;">₱4,999.00<span class="fs-6 ms-2">/per pax</span></p>
                    </div>
                    <a href="#" class="btn btn-success w-100 mt-2">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <div class="container-fluid py-5 bg-success text-white text-center">
        <h2 class="mb-5 fw-bold fs-1">Hear From Other Travellers!</h2>

        <div class="row row-cols-1 row-cols-md-3 g-4 p-5 justify-content-center">
            <div class="col-6 col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm pt-5 mt-4 position-relative overflow-visible">   
                <div class="position-absolute top-0 start-50 translate-middle">
                    <img src="frontend/assets/images/package3.jpg" class="rounded-circle border border-4 border-white" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="card-body text-dark">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title text-success mb-0 fw-bold">Ralph Alcantara</h5>
                    <div class="text-warning">★★★★★</div> <!-- eto ay papalitan huh dapat updated ito mula sa inputs ng customer -->
                </div>
                <p class="card-text text-start">
                    Well okay naman, maganda, pretty, beatiful place. Sobrang saya ko sa trip na to.Hahahahahah!!!! Sanall
                </p>
                </div>
            </div>
            </div>

            <div class="col-6 col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm pt-5 mt-4 position-relative overflow-visible">   
                <div class="position-absolute top-0 start-50 translate-middle">
                    <img src="frontend/assets/images/package3.jpg" class="rounded-circle border border-4 border-white" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="card-body text-dark">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title text-success mb-0 fw-bold">Ralph Alcantara</h5>
                    <div class="text-warning">★★★★★</div> <!-- eto ay papalitan huh dapat updated ito mula sa inputs ng customer -->
                </div>
                <p class="card-text text-start">
                    Well okay naman, maganda, pretty, beatiful place. Sobrang saya ko sa trip na to.Hahahahahah!!!! Sanall
                </p>
                </div>
            </div>
            </div>

            <div class="col-6 col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm pt-5 mt-4 position-relative overflow-visible">   
                <div class="position-absolute top-0 start-50 translate-middle">
                    <img src="frontend/assets/images/package3.jpg" class="rounded-circle border border-4 border-white" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="card-body text-dark">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title text-success mb-0 fw-bold">Ralph Alcantara</h5>
                    <div class="text-warning">★★★★★</div> <!-- eto ay papalitan huh dapat updated ito mula sa inputs ng customer -->
                </div>
                <p class="card-text text-start">
                    Well okay naman, maganda, pretty, beatiful place. Sobrang saya ko sa trip na to.Hahahahahah!!!! Sanall
                </p>
                </div>
            </div>
            </div>

            </div>
        </div>


        <?php include "frontend/components/footer.php"; ?>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
