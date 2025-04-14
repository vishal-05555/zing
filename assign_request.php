<?php
// filepath: c:\x2\htdocs\zing\assign_request.php
session_start();
include 'database.php'; // Include database connection

// Ensure the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect to admin login page
    exit;
}

// Fetch all providers
$providers_sql = "SELECT id, company_name FROM service_providers";
$providers_result = $conn->query($providers_sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service = htmlspecialchars($_POST['service']);
    $customer_location = htmlspecialchars($_POST['customer_location']);
    $provider_id = htmlspecialchars($_POST['provider_id']);

    // Insert the request into the service_requests table
    $sql = "INSERT INTO service_requests (service, customer_location, provider_id, status)
            VALUES (?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $service, $customer_location, $provider_id);

    if ($stmt->execute()) {
        $success_message = "Request assigned successfully!";
    } else {
        $error_message = "Failed to assign the request. Please try again.";
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
    <title>Assign Request</title>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center">Assign Service Request</h1>
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <select class="form-control" id="service" name="service" required>
                    <option value="Tire Puncture">Tire Puncture</option>
                    <option value="Key Lost Service">Key Lost Service</option>
                    <option value="Mechanical Help">Mechanical Help</option>
                    <option value="Petrol Refuelling">Petrol Refuelling</option>
                    <option value="Tow Service">Tow Service</option>
                    <option value="Battery Service">Battery Service</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="customer_location" class="form-label">Customer Location</label>
                <input type="text" class="form-control" id="customer_location" name="customer_location" placeholder="Enter customer location" required>
            </div>
            <div class="mb-3">
                <label for="provider_id" class="form-label">Assign to Provider</label>
                <select class="form-control" id="provider_id" name="provider_id" required>
                    <?php while ($provider = $providers_result->fetch_assoc()): ?>
                        <option value="<?php echo $provider['id']; ?>"><?php echo $provider['company_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Assign Request</button>
        </form>
    </div>
</body>
</html>