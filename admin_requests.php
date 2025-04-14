<!-- filepath: c:\x2\htdocs\zing\admin_requests.php -->
<?php
include 'header.php';
include 'database.php'; // Include your database connection file

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<div class='alert alert-danger text-center'>Access denied. Please log in as an admin.</div>";
    exit;
}

// Handle "Take Action" button submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action']; // Accept or Reject

    // Update the status of the request in the database
    $status = ($action === 'accept') ? 'Accepted' : 'Rejected';
    $sql = "UPDATE service_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $request_id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Request has been $status successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Failed to update the request. Please try again.</div>";
    }
}

// Fetch all customer requests
$sql = "SELECT sr.id, sr.service, sr.customer_location, sr.status, c.phone AS customer_phone, sp.company_name AS provider_name
        FROM service_requests sr
        JOIN customers c ON sr.customer_id = c.id
        JOIN service_providers sp ON sr.provider_id = sp.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Admin - Customer Requests</title>
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

        .table {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Customer Requests</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Service</th>
                        <th>Customer Location</th>
                        <th>Customer Phone</th>
                        <th>Provider</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['service']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_location']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['provider_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <?php if ($row['status'] === 'Pending'): ?>
                                    <form method="POST" action="" class="d-inline">
                                        <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="accept" class="btn btn-success btn-sm btn-action">Accept</button>
                                    </form>
                                    <form method="POST" action="" class="d-inline">
                                        <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm btn-action">Reject</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">No actions available</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No customer requests found.</div>
        <?php endif; ?>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>