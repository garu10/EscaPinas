<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .tour-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 15px;
        }

        .form-control-soft {
            background-color: #f1f3f5;
            border: none;
            padding: 10px 15px;
        }

        .form-control-soft:focus {
            background-color: #e9ecef;
            box-shadow: none;
            outline: 2px solid #198754;
        }

        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-success:hover {
            background-color: #146c43;
        }
    </style>
</head>

<body>

    <?php include "components/navbar.php"; ?>

    <div class="container my-5">

        <!-- Travel Information -->
        <div class=" h5 text-success fw-bold mb-3">Travel Information</div>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="Tour" class="tour-img shadow-sm" >
                </div>
                <div class="col-md-8">
                    <div class="h5 fw-bold mb-2">Package name</div>
                    <div class="row mb-2 text-muted small">
                        <div class="col"><i class="fas fa-map-marker-alt"></i> CAR</div> <!-- REGION ito yata -->
                        <div class="col"><i class="far fa-calendar-alt"></i> Jan 1-2</div> <!-- DATES ito need dropdown or date type keme -->
                        <div class="col"><i class="far fa-clock"></i> 3D2N</div> <!--automatic ito galing sa database -->
                        <div class="col"><i class="fas fa-star text-warning"></i> 4.9</div> <!-- rating galing sa database -->
                    </div>
                    <div class="small text-muted">
                        <i class="fas fa-check-circle text-success me-2"></i> Includes transportation and transient accommodation
                    </div>
                    <div class="h6 fw-bold text-dark mb-3">₱10,650.00 / PAX</div> <!-- base price ito ng PAX -->
                    <div class="row bg-light rounded px-2 py-1 w-50">
                        <div class="col text-center">
                            <button class="btn btn-sm btn-outline-secondary fw-bold">-</button>
                        </div>
                        <div class="col text-center fw-bold">5</div> <!-- pax count need clickable ang dagdag and minus -->
                        <div class="col text-center">
                            <button class="btn btn-sm btn-outline-secondary fw-bold">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="h5 text-success fw-bold mb-3">Personal Information</div>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <form>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-success" for="lname">Last Name</label>
                        <input type="text" class="form-control rounded-3" id="lname">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-success" for="fname">First Name</label>
                        <input type="text" class="form-control rounded-3" id="fname">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-success" for="initial">M.I.</label>
                        <input type="text" class="form-control rounded-3" id="initial">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <label class="form-label small fw-bold text-success">Email Address</label>
                        <input type="email" class="form-control rounded-3" >
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-bold text-success">Contact Number</label>
                        <input type="text" class="form-control rounded-3">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-success">Address</label>
                        <input type="text" class="form-control rounded-3">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-success">Region</label>
                        <select class="form-select rounded-3">
                            <option>Luzon</option>
                            <option>Visayas</option>
                            <option selected>Mindanao</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-success">City</label>
                        <select class="form-select rounded-3">
                            <option selected>Davao City</option>
                            <option>Cagayan de Oro</option>
                            <option>General Santos</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-success">Island Group</label>
                        <input type="text" class="form-control rounded-3" >
                    </div>
                </div>
            </form>
        </div>

        <!-- Coupon -->
        <div class="row mb-4">
            <div class="col">
                <div class="alert alert-success fw-bold border-success" role="alert">
                    <i class="fas fa-ticket-alt me-2 fs-5"></i> 30% Off by BKS
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="text-center text-success fw-bold mb-4">Purchase Summary</div>
            <div class="row mb-2">
                <div class="col">Price</div>
                <div class="col text-end fw-bold">₱00000</div>
            </div>
            <div class="row mb-2">
                <div class="col">Tax VAT</div>
                <div class="col text-end fw-bold">₱00000</div>
            </div>
            <div class="row mb-2 text-success">
                <div class="col">Discount</div>
                <div class="col text-end fw-bold">- ₱00000</div>
            </div>
            <div class="row mb-3 text-success">
                <div class="col">Booking Fees</div>
                <div class="col text-end fw-bold">₱0.00</div>
            </div>
            <hr>
            <div class="row mt-3 fs-5 fw-bold">
                <div class="col">Total Price</div>
                <div class="col text-end">₱000000</div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
            <div class="h6 text-success fw-bold mb-3">Choose Payment Method</div>
            <div class="row mb-4">
                <div class="col">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success active">E-Wallet</button>
                        <button type="button" class="btn btn-outline-secondary">Card</button>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" width="100">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <p class="small text-muted">You will be redirected to PayPal to complete your transaction securely.</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="row">
                        <div class="col fw-bold">TOTAL PAYMENT:</div>
                        <div class="col text-end text-success fs-4 fw-bold">₱8,013.00</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-success w-100 py-3 fw-bold rounded-3">
                        <i class="fab fa-paypal me-2"></i> Pay with PayPal </button>
                </div>
            </div>
        </div>
    </div>
    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>