<?php
session_start(); // Start the session at the very top of the file

if (!isset($_SESSION['registration_success']) || $_SESSION['registration_success'] !== true) {
    header('Location: user_register.php');
    exit();
}

unset($_SESSION['registration_success']);
?>
<?php include 'header.php'; ?> <!-- Include your header here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Include your custom styles -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
            font-family: 'Arial', sans-serif;
        }
        .thank-you-container {
            margin-top: 100px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 40px;
        }
        .text-success {
            font-size: 2rem;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .lead {
            font-size: 1.2rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container thank-you-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="text-success mb-4">Thank You for Registering!</h1>
                        <p class="lead mb-4">Your account has been successfully created. You can now log in to access your account and explore our features.</p>
                        <a href="login.php" class="btn btn-primary">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php include 'footer.php'; ?> <!-- Include your footer here -->