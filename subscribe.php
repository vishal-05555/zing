<!-- filepath: c:\x2\htdocs\zing\subscribe.php -->
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Subscription Status</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .subscription-container {
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

        .alert {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .btn-home {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            text-decoration: none;
        }

        .btn-home:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Subscription Status</h1>
            <p class="lead">Check the status of your subscription below</p>
        </div>
    </div>

    <!-- Subscription Status -->
    <div class="container py-5">
        <div class="subscription-container text-center">
            <?php
            include 'database.php'; // Include your database connection file

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];

                // Validate email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='alert alert-danger'>Invalid email address!</div>";
                    exit;
                }

                try {
                    // Insert email into the database
                    $sql = "INSERT INTO email_subscriptions (email) VALUES (?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();

                    echo "<div class='alert alert-success'>Thank you for subscribing!</div>";
                } catch (mysqli_sql_exception $e) {
                    // Check for duplicate entry error
                    if ($e->getCode() == 1062) { // Error code 1062 is for duplicate entry
                        echo "<div class='alert alert-danger'>This email is already subscribed!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>An error occurred. Please try again later.</div>";
                    }
                } finally {
                    $stmt->close();
                    $conn->close();
                }
            }
            ?>
            <a href="index.php" class="btn btn-home mt-4">Go Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>