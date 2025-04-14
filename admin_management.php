<!-- filepath: c:\x2\htdocs\zing\admin_management.php -->
<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit;
}
?>
<?php
// admin_management.php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'remove') {
        $providerId = $_POST['provider_id'];
        // Remove service provider logic
        $sql = "DELETE FROM service_providers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $providerId);
        $stmt->execute();
        echo "<div class='alert alert-success'>Service provider removed successfully!</div>";
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
    <title>Admin Management</title>
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

        .management-container {
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

        .provider-table {
            margin-top: 30px;
        }

        .provider-table th, .provider-table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Admin Management</h1>
            <p class="lead">Manage service providers and platform activities</p>
        </div>
    </div>

    <!-- Management Section -->
    <div class="container py-5">
        <div class="management-container">
            <h2>Manage Service Providers</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="provider_id" class="form-label">Provider ID</label>
                    <input type="text" class="form-control" id="provider_id" name="provider_id" placeholder="Enter Provider ID" required>
                </div>
                <div class="mb-3">
                    <label for="action" class="form-label">Action</label>
                    <select class="form-select" id="action" name="action" required>
                        <option value="remove">Remove Provider</option>
                        <option value="view">View Providers</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom w-100">Execute</button>
            </form>
        </div>

        <?php
        // View Providers Logic
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'view') {
            $sql = "SELECT * FROM service_providers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='provider-table mt-5'>";
                echo "<h3 class='text-center mb-4'>Service Providers</h3>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='table-light'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Company Name</th>";
                echo "<th>Phone</th>";
                echo "<th>Location</th>";
                echo "<th>Service Provided</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['service_provided']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mt-4'>No service providers found.</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>