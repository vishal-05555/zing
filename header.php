<?php
// Ensure no output is sent before this point
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}
?>
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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-car-mechanic me-2"></i>Vehicle Assistance
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact_us.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn text-white ms-lg-3 px-3" href="login.php" style="background-color: rgb(52, 152, 219); border-radius: 5px;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn text-white ms-lg-1 px-3" href="provider_login.php" style="background-color: rgb(52, 152, 219); border-radius: 5px;">Provider Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn text-white ms-lg-1 px-3" href="admin_login.php" style="background-color: rgb(52, 152, 219); border-radius: 5px;">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
            background-color:rgb(83, 158, 207);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .button-container button:hover {
            background-color:rgb(88, 162, 211);
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
            color:rgb(84, 157, 206);
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
            background:rgb(88, 165, 217);
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
            background: linear-gradient(135deg, #3498db, #2ecc71);
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