<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/assets/css/banner.css">
</head>

<body>
    <div class="container-fluid p-0 position-relative" style="background: url('assets/banner.png') no-repeat center center; background-size: cover; height: 80vh;">
    
            <div class="row g-0 h-50 align-items-end px-lg-5">
                <div class="col-12 offset-lg-1 text-start text-white">
                    <div class="p-4 rounded-3">
                        <h1 class="display-1 fw-bold text-success fst-italic" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.3);">Magandang Araw!</h1>
                        <p class="lead fs-3 fw-light">Explore beautiful places in the Philippines with EscaPinas</p>
                    </div>
                </div>
            </div>

            <div class="row g-0 h-50 align-items-start justify-content-center">
                <div class="col-11 col-lg-10 col-xl-8"> <div class="card border-0 shadow-lg p-2 bg-success bg-opacity-75" style="backdrop-filter: blur(10px); border-radius: 15px;">
                        <div class="card-body p-0">
                            <form action="search.php" method="GET" class="row g-0 align-items-center">
                                <div class="col-md-4 border-end border-white border-opacity-50 px-3 mb-3 mb-md-0">
                                    <label class="small fw-bold text-muted mb-1 d-block"><i class="bi bi-geo-alt me-1"></i> Destination</label>
                                    <input type="text" class="form-control border-0 bg-transparent p-0" placeholder="Where to go?">
                                </div>

                                <div class="col-md-3 border-end border-white border-opacity-50 px-3 mb-3 mb-md-0">
                                    <label class="small fw-bold text-muted mb-1 d-block"><i class="bi bi-calendar-event me-1"></i> Date</label>
                                    <input type="date" class="form-control border-0 bg-transparent p-0">
                                </div>

                                <div class="col-md-3 px-3 mb-3 mb-md-0 border-end border-white border-opacity-50">
                                    <label class="small fw-bold text-muted mb-1 d-block"><i class="bi bi-people me-1"></i> Travelers</label>
                                    <select class="form-select border-0 bg-transparent p-0">
                                        <option selected>1 Person</option>
                                        <option value="2">2 People</option>
                                        <option value="3">3+ People</option>
                                    </select>
                                </div>

                                <div class="col-md-2 p-1">
                                    <button type="submit" class="btn btn-success w-100 h-100 bo py-3 rounded-3">
                                        <i class="bi bi-search me-2"></i>Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>             
</html>

