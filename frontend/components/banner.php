<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EscaPinas</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="frontend/assets/css/bannerStyle.css">
</head>

<body>
    <div class="container-fluid p-0 banner-light" style="background-image:url('frontend/assets/images/banner_index.jpg'); background-size:cover; background-position:center; height:400px; position:relative;">
        <div class="row g-0 h-50 align-items-end px-3 px-lg-5 banner-content">
            <div class="col-12 text-start">
            </div>
        </div>

        <div class="row p-5 g-0 h-50 align-items-start justify-content-center banner-content">
            <div class="col-12 col-lg-10 col-xl-8 px-3">
            <div class="card border-0 p-3 search-card">
                <div class="card-body p-0">
            <form action="banner.php" method="GET" class="row g-2 align-items-center">

                <div class="col-md-4">
                    <label class="small fw-bold mb-1 d-block"><i class="fa-solid fa-location-dot me-1"></i> Destination</label>
                    <input type="text" name="destination" class="form-control p-2" placeholder="Where to go?">
                </div>

                <div class="col-md-4">
                    <label class="small fw-bold mb-1 d-block"><i class="fa-solid fa-calendar-days me-1"></i> Date</label>
                    <input type="date" name="travel_date" class="form-control p-2">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-success w-100 py-2 mt-4 rounded-3">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Search
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
