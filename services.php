<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Our Services</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .services-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .services-list {
            list-style: none;
            padding: 0;
        }

        .services-list li {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .services-list li i {
            color: #3498db;
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .btn-custom {
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Our Services</h1>
            <p class="lead">Explore the services we offer to assist you in any situation</p>
        </div>
    </div>

      <!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
            <a href="battery_service.php" class="text-decoration-none text-dark">
                <div class="service-card text-center">
                    <i class="fas fa-car-battery mb-3"></i>
                    <h3>Battery Service</h3>
                    <p>Jump start your vehicle or get a new battery installed on the spot.</p>
                </div>
            </a>
            </div>

            <div class="col-md-4">
    <a href="fuel_delivery.php" class="text-decoration-none text-dark">
        <div class="service-card text-center">
            <i class="fas fa-gas-pump mb-3"></i>
            <h3>Fuel Delivery</h3>
            <p>Run out of fuel? We'll deliver fuel to your location quickly.</p>
        </div>
    </a>
</div>

           
<div class="col-md-4">
    <a href="tire_puncture.php" class="text-decoration-none text-dark">
        <div class="service-card text-center">
            <i class="fas fa-dharmachakra me-2"></i>
            <h3>Tire Service</h3>
            <p>Flat tire? Get professional tire repair or replacement service.</p>
        </div>
    </a>
</div>
          

            <div class="col-md-4"><a href="tow_service.php" class="text-decoration-none text-dark">
                <div class="service-card text-center">
                    <i class="fas fa-truck-pickup mb-3"></i>
                    <h3>Towing Service</h3>
                    <p>Vehicle won't start? We'll tow it to the nearest service station.</p>
                </div></a>
            </div>
            <div class="col-md-4"> <a href="key_service.php" class="text-decoration-none text-dark">

                <div class="service-card text-center">
                    <i class="fas fa-key mb-3"></i>
                    <h3>Key Service</h3>
                    <p>Locked out? Get help with key replacement or lockout service.</p>
                </div>
            </a>
            </div>
            <div class="col-md-4"><a href="mechanical_help.php" class="text-decoration-none text-dark">
                <div class="service-card text-center">
                    <i class="fas fa-tools mb-3"></i>
                    <h3>Mechanical Help</h3>
                    <p>Basic mechanical repairs and diagnostics at your location.</p>
                </div>
            </a>
            </div>
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>