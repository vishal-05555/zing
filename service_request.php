<?php include 'header.php'; ?>
<?php
// filepath: c:\x2\htdocs\zing\service_request.php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle service request submission
    $service = htmlspecialchars($_POST['service']);
    $customer_location = htmlspecialchars($_POST['customer_location']);
    $provider_id = htmlspecialchars($_POST['provider_id']);
    $customer_id = $_SESSION['customer_id']; // Assuming the customer is logged in

    // Insert a new service request
    $sql = "INSERT INTO service_requests (service, customer_location, customer_id, provider_id, status)
            VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $service, $customer_location, $customer_id, $provider_id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Service request submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Failed to submit service request. Please try again.</div>";
    }
}

// Fetch all service requests for the logged-in user
$customer_id = $_SESSION['id']; // Assuming the customer is logged in
$sql = "SELECT sr.id, sr.service, sr.customer_location, sr.status, sp.company_name AS provider_name
        FROM service_requests sr
        LEFT JOIN service_providers sp ON sr.provider_id = sp.id
        WHERE sr.customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Service Request</title>
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

        .request-container {
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

        .form-control, .btn-custom {
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Request a Service</h1>
            <p class="lead">Submit your service request and view its status</p>
        </div>
    </div>

    <!-- Service Request Form -->
    <div class="container py-5">
        <div class="request-container">
            <h2 class="text-center mb-4">Service Request Form</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="service" class="form-label">Service Type</label>
                    <input type="text" class="form-control" id="service" name="service" placeholder="Enter the service type" required>
                </div>
                <div class="mb-3">
                    <label for="customer_location" class="form-label">Your Location</label>
                    <input type="text" class="form-control" id="customer_location" name="customer_location" placeholder="Enter your location" required>
                </div>
                <div class="mb-3">
                    <label for="provider_id" class="form-label">Provider ID</label>
                    <input type="text" class="form-control" id="provider_id" name="provider_id" placeholder="Enter the provider ID" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Submit Request</button>
            </form>
        </div>
    </div>

    <!-- Display Service Requests -->
    <div class="container py-5">
        <div class="request-container">
            <h2 class="text-center mb-4">Your Service Requests</h2>
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Location</th>
                            <th>Provider</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['service']); ?></td>
                                <td><?php echo htmlspecialchars($row['customer_location']); ?></td>
                                <td><?php echo htmlspecialchars($row['provider_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">No service requests found.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>