<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'database.php'; // Include database connection
include 'header.php'; // Include header

if (!isset($_SESSION['provider_logged_in']) || !$_SESSION['provider_logged_in']) {
    header('Location: provider_login.php'); // Redirect to login if not logged in
    exit;
}

$provider_id = $_SESSION['provider_id']; // Get the logged-in provider's ID

// Fetch service requests assigned to this provider
$sql = "SELECT sr.id, sr.service, sr.customer_name, sr.customer_email, sr.customer_phone, sr.customer_location, sr.status, sr.created_at
        FROM service_requests sr
        WHERE sr.provider_id = ?
        ORDER BY sr.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Provider Dashboard</title>
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
            color: #3498db;
        }

        .request-card p {
            margin: 5px 0;
            color: #555;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['provider_name']); ?></h1>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="request-card">
                    <h3>Service: <?php echo htmlspecialchars($row['service']); ?></h3>
                    <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($row['customer_name']); ?></p>
                    <p><strong>Customer Email:</strong> <?php echo htmlspecialchars($row['customer_email']); ?></p>
                    <p><strong>Customer Phone:</strong> <?php echo htmlspecialchars($row['customer_phone']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['customer_location']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                    <p><strong>Created At:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>

                    <?php if ($row['status'] === 'Pending'): ?>
                        <form method="POST" action="basic.php">
                            <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
                    <?php else: ?>
                        <p><strong>Action Taken:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No service requests assigned to you.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>