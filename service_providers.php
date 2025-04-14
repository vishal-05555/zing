<!-- filepath: c:\x2\htdocs\zing\fuel_delivery.php -->
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Fuel Delivery Service</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(135deg, #f39c12, #e74c3c);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .provider {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 15px;
        }

        .provider h3 {
            margin: 0;
            color: #f39c12;
        }

        .provider p {
            margin: 5px 0;
            color: #555;
        }

        .no-providers {
            text-align: center;
            color: #555;
            font-size: 1.2rem;
        }

        .btn-request {
            background-color: #f39c12;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .btn-request:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Fuel Delivery Service</h1>
            <p class="lead">Quick and reliable fuel delivery to get you back on the road.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center mb-4">Available Providers Near You</h2>
        <form method="GET" action="" class="request-form">
            <div class="mb-3">
                <label for="location" class="form-label">Enter Your Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
            </div>
            <button type="submit" class="btn btn-request w-100">Find Providers</button>
        </form>

        <?php
        include 'database.php'; // Include your database connection file

        // Start the session only if it is not already active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Debugging: Check if customer_id is set in the session
        if (!isset($_SESSION['customer_id'])) {
            echo "<div class='alert alert-danger text-center'>Error: Customer ID is not set. Please log in again.</div>";
            exit;
        }

        $customer_id = $_SESSION['customer_id']; // Get the logged-in customer's ID

        // Handle request submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provider_id'])) {
            $provider_id = $_POST['provider_id'];
            $user_location = htmlspecialchars($_POST['user_location']);
            $service = 'Fuel Delivery';

            // Insert the request into the database
            $sql = "INSERT INTO service_requests (service, customer_location, customer_id, provider_id, status) VALUES (?, ?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $service, $user_location, $customer_id, $provider_id);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Request sent successfully!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Failed to send request. Please try again.</div>";
            }
        }

        // Assume the user's location is passed via a GET request
        $user_location = $_GET['location'] ?? '';

        if ($user_location) {
            // Query to fetch fuel delivery service providers near the user
            $sql = "SELECT * FROM service_providers WHERE service_provided LIKE ? AND location = ?";
            $stmt = $conn->prepare($sql);
            $service = '%fuel delivery%';
            $stmt->bind_param("ss", $service, $user_location);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display the providers
            if ($result->num_rows > 0) {
                $providers = $result->fetch_all(MYSQLI_ASSOC);

                echo "<h3 class='text-center mt-4'>Providers in " . htmlspecialchars($user_location) . "</h3>";

                foreach ($providers as $provider) {
                    echo "<div class='provider'>";
                    echo "<h3>" . htmlspecialchars($provider['company_name']) . "</h3>";
                    echo "<p><strong>Phone:</strong> " . htmlspecialchars($provider['phone']) . "</p>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($provider['location']) . "</p>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='provider_id' value='" . htmlspecialchars($provider['id']) . "'>";
                    echo "<input type='hidden' name='user_location' value='" . htmlspecialchars($user_location) . "'>";
                    echo "<button type='submit' class='btn btn-request'>Send Request</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-providers'>No fuel delivery service providers found near your location.</p>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<p class='no-providers'>Please provide your location to find nearby providers.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>