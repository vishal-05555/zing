<?php
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Vehicle Assistance</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Custom Styles -->
    <style>
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            position: relative;
            overflow: hidden;
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        .card {
            margin-bottom: 1.5rem;
        }

        .card-title {
            color: #3498db;
        }

        .list-group-item {
            border: none;
        }

        .list-group-item strong {
            color: #3498db;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }

        .text-center a {
            color: #3498db;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">About Us</h1>
            <p class="lead mb-4">Learn more about Vehicle Assist and our mission to provide reliable roadside assistance.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="text-center mb-4"></h1>

        <!-- Introduction -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Who We Are</h5>
                <p class="card-text">
                    Welcome to <strong>Vehicle Assist</strong>, your reliable roadside assistance platform designed to help you in times of vehicle emergencies. 
                    Whether you have a flat tire, lost your keys, need towing, or require fuel refilling, we connect you with trusted service providers 
                    in your area to get you back on the road quickly.
                </p>
            </div>
        </div>

        <!-- Our Mission & Vision -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Our Mission</h5>
                        <p class="card-text">
                            Our mission is to provide quick, reliable, and affordable roadside assistance by connecting users with verified 
                            service providers, ensuring a hassle-free experience.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Our Vision</h5>
                        <p class="card-text">
                            We aim to be the most trusted platform for vehicle assistance services, making road travel safer and stress-free for everyone.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">How It Works</h5>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">Users visit our website and select their required roadside assistance service.</li>
                    <li class="list-group-item">We display the nearest verified service providers with their contact details.</li>
                    <li class="list-group-item">The service provider receives a notification and accepts the request.</li>
                    <li class="list-group-item">Real-time tracking of the service provider is enabled for customer reassurance.</li>
                    <li class="list-group-item">Upon service completion, the customer makes the payment via Razorpay or cash.</li>
                    <li class="list-group-item">A 20% commission is deducted automatically from the service provider's registered bank account.</li>
                </ol>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Why Choose Us?</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Verified Service Providers:</strong> We ensure all providers have legal licenses and valid registrations.</li>
                    <li class="list-group-item"><strong>Real-Time Tracking:</strong> Track the service provider’s location in real-time.</li>
                    <li class="list-group-item"><strong>Secure Payments:</strong> Razorpay integration for secure transactions.</li>
                    <li class="list-group-item"><strong>24/7 Support:</strong> AI chatbot and live support for instant assistance.</li>
                    <li class="list-group-item"><strong>Fraud Protection:</strong> Admin panel to detect and remove fraudulent activities.</li>
                </ul>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card shadow text-center">
            <div class="card-body">
                <h5 class="card-title">Get in Touch</h5>
                <p class="card-text">
                    Have any questions or need assistance? Contact us!
                </p>
                <p><strong>Email:</strong> <a href="mailto:support@vehicleassist.com">support@vehicleassist.com</a></p>
                <p><strong>Phone:</strong> +91 XXXXXXXXXX</p>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>