<!-- filepath: c:\x2\htdocs\zing\key_service.php -->
<?php
include 'header.php';
include 'database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already active
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provider_id'])) {
    $provider_id = $_POST['provider_id'];
    $user_location = htmlspecialchars($_POST['user_location']);
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $customer_email = htmlspecialchars($_POST['customer_email']);
    $customer_phone = htmlspecialchars($_POST['customer_phone']);
    $service = 'Key Service';

    // Insert the service request into the database
    $sql = "INSERT INTO service_requests (service, customer_location, customer_name, customer_email, customer_phone, provider_id, status) 
            VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $service, $user_location, $customer_name, $customer_email, $customer_phone, $provider_id);

    if ($stmt->execute()) {
        $success_message = "Request sent successfully!";
    } else {
        $error_message = "Failed to send request. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Key Service</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(135deg, #8e44ad, #2c3e50);
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
            color: #8e44ad;
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
            background-color: #8e44ad;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .btn-request:hover {
            background-color: #732d91;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Key Service</h1>
            <p class="lead">Professional key services to help you get back on the road.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center mb-4">Available Providers Near You</h2>

        <!-- Display Success or Error Message -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="GET" action="" class="request-form">
            <div class="mb-3">
                <label for="location" class="form-label">Enter Your Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="customer_email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="customer_phone" class="form-label">Your Phone Number</label>
                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter your phone number" required>
            </div>
            <button type="submit" class="btn btn-request w-100">Find Providers</button>
        </form>

        <?php
        // Assume the user's location is passed via a GET request
        $user_location = $_GET['location'] ?? '';

        if ($user_location) {
            // Query to fetch key service providers near the user
            $sql = "SELECT * FROM service_providers WHERE service_provided LIKE ? AND location = ?";
            $stmt = $conn->prepare($sql);
            $service = '%key service%';
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
                    echo "<input type='hidden' name='customer_name' value='" . htmlspecialchars($_GET['customer_name']) . "'>";
                    echo "<input type='hidden' name='customer_email' value='" . htmlspecialchars($_GET['customer_email']) . "'>";
                    echo "<input type='hidden' name='customer_phone' value='" . htmlspecialchars($_GET['customer_phone']) . "'>";
                    echo "<button type='submit' class='btn btn-request'>Send Request</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-providers'>No key service providers found near your location.</p>";
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