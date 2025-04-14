
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Assistance</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Custom Styles -->
    <style>
        /* Hero section styling */
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            position: relative;
            overflow: hidden;
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        /* Navigation styling */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            color: #3498db;
        }
        
        /* Button container styling */
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .button-container button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .button-container button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }
        
        /* Services list styling */
        .services-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .services-list li {
            padding: 1.5rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s ease;
        }
        
        .services-list li:hover {
            transform: translateY(-5px);
        }
        
        .services-list i {
            font-size: 1.5rem;
            color: #3498db;
        }
        
        /* Service cards styling */
        .service-card {
            padding: 2rem;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card i {
            font-size: 3rem;
            color: #3498db;
        }

        /* Step cards styling */
        .step-card {
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: #3498db;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Feature cards styling */
        .feature-card {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        /* CTA section styling */
        .cta-section {
            background: linear-gradient(135deg,rgb(52, 152, 219), #2ecc71);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                text-align: center;
            }

            .service-card,
            .step-card,
            .feature-card {
                margin-bottom: 1rem;
            }
            
            .button-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>


    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">24/7 Emergency Vehicle Assistance</h1>
            <p class="lead mb-4">Get instant help for vehicle breakdowns, tire punctures, fuel delivery, and more.</p>
            <div class="button-container">
                <button onclick="location.href='user_register.php'"><i class="fas fa-car me-2"></i> Customer</button>
                <button onclick="location.href='register.php'"><i class="fas fa-user-plus me-2"></i> Service Provider</button>
                <button onclick="location.href='admin_login.php'"><i class="fas fa-info-circle me-2"></i> Admin</button>
                
            </div>
        </div>
    </div>

   <!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-car-battery mb-3"></i>
                    <h3>Battery Service</h3>
                    <p>Jump start your vehicle or get a new battery installed on the spot.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-gas-pump mb-3"></i>
                    <h3>Fuel Delivery</h3>
                    <p>Run out of fuel? We'll deliver fuel to your location quickly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-dharmachakra me-2"></i>
                    <h3>Tire Service</h3>
                    <p>Flat tire? Get professional tire repair or replacement service.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-truck-pickup mb-3"></i>
                    <h3>Towing Service</h3>
                    <p>Vehicle won't start? We'll tow it to the nearest service station.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-key mb-3"></i>
                    <h3>Key Service</h3>
                    <p>Locked out? Get help with key replacement or lockout service.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-tools mb-3"></i>
                    <h3>Mechanical Help</h3>
                    <p>Basic mechanical repairs and diagnostics at your location.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">How It Works</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="step-card text-center">
                    <div class="step-number">1</div>
                    <h4>Request Service</h4>
                    <p>Choose the service you need and share your location</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card text-center">
                    <div class="step-number">2</div>
                    <h4>Get Matched</h4>
                    <p>We'll connect you with nearby service providers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card text-center">
                    <div class="step-number">3</div>
                    <h4>Track Provider</h4>
                    <p>Track your service provider's location in real-time</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card text-center">
                    <div class="step-number">4</div>
                    <h4>Pay & Review</h4>
                    <p>Pay securely and rate your experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Us</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-clock"></i>
                    <h4>24/7 Service</h4>
                    <p>Available round the clock for emergency assistance</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Verified Providers</h4>
                    <p>All service providers are verified and trained</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-map-marked-alt"></i>
                    <h4>Live Tracking</h4>
                    <p>Track your service provider in real-time</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-rupee-sign"></i>
                    <h4>Transparent Pricing</h4>
                    <p>No hidden charges, pay only for what you need</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-star"></i>
                    <h4>Rated Service</h4>
                    <p>Rate and review service providers</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-headset"></i>
                    <h4>24/7 Support</h4>
                    <p>Customer support available all day, every day</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">Join thousands of satisfied customers who trust our service</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="user_register.php" class="btn btn-light btn-lg">
                <i class="fas fa-user-plus me-2"></i>Sign Up Now
            </a>
        <?php else: ?>
            <a href="user_register.php" class="btn btn-light btn-lg">
                <i class="fas fa-wrench me-2"></i>Register as a customer
            </a>
        <?php endif; ?>
    </div>
</section>



<?php include 'footer.php'; ?>