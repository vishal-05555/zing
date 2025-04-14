<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Sitemap</title>
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

        .sitemap-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .sitemap-container ul {
            list-style: none;
            padding: 0;
        }

        .sitemap-container ul li {
            margin-bottom: 1rem;
        }

        .sitemap-container ul li a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .sitemap-container ul li a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Sitemap</h1>
            <p class="lead">Navigate through our website with ease</p>
        </div>
    </div>

    <!-- Sitemap Section -->
    <div class="container py-5">
        <div class="sitemap-container">
            <ul>
                <li><a href="index.php"><i class="fas fa-home me-2"></i>Home</a></li>
                <li><a href="services.php"><i class="fas fa-concierge-bell me-2"></i>Services</a></li>
                <li><a href="service_providers.php"><i class="fas fa-users me-2"></i>Service Providers</a></li>
                <li><a href="faq.php"><i class="fas fa-question-circle me-2"></i>FAQ</a></li>
                <li><a href="contact_us.php"><i class="fas fa-envelope me-2"></i>Contact Us</a></li>
                <li><a href="about_us.php"><i class="fas fa-info-circle me-2"></i>About Us</a></li>
                <li><a href="privacy_policy.php"><i class="fas fa-shield-alt me-2"></i>Privacy Policy</a></li>
                <li><a href="terms_of_service.php"><i class="fas fa-file-alt me-2"></i>Terms of Service</a></li>
                <li><a href="admin.php"><i class="fas fa-user-shield me-2"></i>Admin Panel</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>