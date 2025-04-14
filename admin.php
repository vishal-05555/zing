<!-- filepath: c:\x2\htdocs\zing\admin.php -->
<?php
session_start(); // Start the session
include 'database.php'; // Include database connection

// Check if the admin is already logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // If not logged in, redirect to the login page
    header('Location: admin_login.php');
    exit;
}
?>

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
    <title>Admin Panel</title>
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

        .admin-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #3498db;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 500;
            color: #3498db;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            margin-bottom: 15px;
            display: inline-block;
            text-align: left;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #2980b9;
        }

        .btn-custom i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Admin Panel</h1>
            <p class="lead">Manage and monitor all activities on the platform</p>
        </div>
    </div>

    <!-- Admin Panel Content -->
    <div class="container py-5">
        <div class="admin-container">
        <h2>View Subscribers</h2>
<button class="btn btn-custom" onclick="location.href='view_subscribers.php'">
    <i class="fas fa-users"></i> View Subscribers
</button>
            <h2>Manage Service Providers</h2>
            <button class="btn btn-custom" onclick="location.href='admin_management.php'">
                <i class="fas fa-user-cog"></i> Manage Providers
            </button>

            <h2>View Messages</h2>
            <button class="btn btn-custom" onclick="location.href='view_messages.php'">
                <i class="fas fa-list"></i> View Customer Messages
            </button>

            <h2>View Customers</h2>
            <button class="btn btn-custom" onclick="location.href='view_customers.php'">
                <i class="fas fa-list"></i> View Customers
            </button>
            
            <h2>View Customer Requests</h2>
            <button class="btn btn-custom" onclick="location.href='view_requests.php'">
                <i class="fas fa-list"></i> View Customer Requests
            </button>
        
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>