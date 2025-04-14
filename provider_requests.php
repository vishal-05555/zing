<?php
// filepath: c:\x2\htdocs\zing\provider_requests.php
ob_start();
session_start();
include 'database.php'; // Include database connection
include 'header.php';

// Ensure the provider is logged in
if (!isset($_SESSION['provider_logged_in']) || $_SESSION['provider_logged_in'] !== true) {
    header('Location: login.php'); // Redirect to provider login page
    exit;
}

// Get the provider ID from the session
$provider_id = $_SESSION['provider_id'];

// Fetch service requests assigned to this provider
$sql = "SELECT sr.id, sr.service, sr.customer_location, sr.status, c.name AS customer_name
        FROM service_requests sr
        JOIN customers c ON sr.customer_id = c.id
        WHERE sr.provider_id = ? AND sr.status = 'Pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();

// Handle Accept/Reject actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Update the request status to 'Accepted'
        $update_sql = "UPDATE service_requests SET status = 'Accepted' WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $request_id);
        $update_stmt->execute();
        echo "<div class='alert alert-success text-center'>You have accepted the request.</div>";
    } elseif ($action === 'reject') {
        // Find the next provider
        $next_provider_sql = "SELECT id FROM service_providers WHERE id > ? LIMIT 1";
        $next_provider_stmt = $conn->prepare($next_provider_sql);
        $next_provider_stmt->bind_param("i", $provider_id);
        $next_provider_stmt->execute();
        $next_provider_result = $next_provider_stmt->get_result();

        if ($next_provider_result->num_rows > 0) {
            $next_provider = $next_provider_result->fetch_assoc()['id'];

            // Assign the request to the next provider
            $update_sql = "UPDATE service_requests SET current_provider_id = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $next_provider, $request_id);
            $update_stmt->execute();
            echo "<div class='alert alert-warning text-center'>You have rejected the request. It has been assigned to the next provider.</div>";
        } else {
            // No more providers available, mark the request as 'Rejected'
            $update_sql = "UPDATE service_requests SET status = 'Rejected' WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $request_id);
            $update_stmt->execute();
            echo "<div class='alert alert-danger text-center'>You have rejected the request. No more providers available.</div>";
        }
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
    <title>Provider Requests</title>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Service Requests</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Customer Location</th>
                        <th>Customer Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['service']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_location']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No service requests assigned to you.</div>
        <?php endif; ?>
        <?php
ob_end_flush(); // Flush the output buffer
?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>