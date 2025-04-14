<!-- filepath: c:\x2\htdocs\zing\view_requests.php -->
<?php
include 'header.php';
include 'database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already active
}

// Fetch all service requests along with user details
$sql = "SELECT sr.id, sr.service, sr.customer_location, sr.status, sr.customer_name, sr.customer_email, sr.customer_phone, sr.created_at
        FROM service_requests sr
        ORDER BY sr.created_at DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Error fetching service requests: " . $conn->error);
}

// Handle the Match button submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provider_id'])) {
    $provider_id = $_POST['provider_id'];
    $request_id = $_POST['request_id'];

    // Logic to send a message to the provider (e.g., insert into a messages table)
    $message = "You have been matched with a service request. Please contact the customer.";
    $sql = "INSERT INTO messages (provider_id, request_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $provider_id, $request_id, $message);

    if ($stmt->execute()) {
        $success_message = "Message sent to the provider successfully!";
    } else {
        $error_message = "Failed to send the message. Please try again.";
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
    <title>View Requests</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .request-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 15px;
        }

        .request-card h3 {
            margin: 0;
            color: #f39c12;
        }

        .request-card p {
            margin: 5px 0;
            color: #555;
        }

        .provider {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .provider p {
            margin: 0;
            color: #333;
        }

        .no-providers {
            color: #555;
            font-size: 1rem;
        }

        .btn-match {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 0.9rem;
        }

        .btn-match:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Service Requests</h1>

        <!-- Display Success or Error Message -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($request = $result->fetch_assoc()): ?>
                <div class="request-card">
                    <h3>Service: <?php echo htmlspecialchars($request['service']); ?></h3>
                    <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($request['customer_name'] ?? 'N/A'); ?></p>
                    <p><strong>Customer Email:</strong> <?php echo htmlspecialchars($request['customer_email'] ?? 'N/A'); ?></p>
                    <p><strong>Customer Phone:</strong> <?php echo htmlspecialchars($request['customer_phone'] ?? 'N/A'); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($request['customer_location']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($request['status']); ?></p>
                    <p><strong>Created At:</strong> <?php echo htmlspecialchars($request['created_at']); ?></p>

                    <!-- Match Providers -->
                    <h4 class="mt-4">Matched Providers:</h4>
                    <?php
                    $location = $request['customer_location'];
                    $service = $request['service'];

                    // Query to fetch providers matching the location and service
                    $provider_sql = "SELECT id, company_name, phone, location FROM service_providers WHERE location = ? AND service_provided LIKE ?";
                    $provider_stmt = $conn->prepare($provider_sql);
                    $service_like = '%' . $service . '%';
                    $provider_stmt->bind_param("ss", $location, $service_like);
                    $provider_stmt->execute();
                    $providers = $provider_stmt->get_result();

                    if ($providers->num_rows > 0):
                        while ($provider = $providers->fetch_assoc()): ?>
                            <div class="provider">
                                <p><strong>Provider Name:</strong> <?php echo htmlspecialchars($provider['company_name']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($provider['phone']); ?></p>
                                <p><strong>Location:</strong> <?php echo htmlspecialchars($provider['location']); ?></p>
                                <form method="POST" action="">
                                    <input type="hidden" name="provider_id" value="<?php echo htmlspecialchars($provider['id']); ?>">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request['id']); ?>">
                                    <button type="submit" class="btn btn-match">Match</button>
                                </form>
                            </div>
                        <?php endwhile;
                    else:
                        echo "<p class='no-providers'>No providers found for this request.</p>";
                    endif;

                    $provider_stmt->close();
                    ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No service requests found.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>