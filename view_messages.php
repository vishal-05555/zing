<?php
// filepath: c:\x2\htdocs\zing\view_messages.php
ob_start();
session_start();
include 'database.php'; // Include database connection
include 'header.php';

// Ensure only logged-in admins can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>View Messages</title>
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

        .messages-container {
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

        .table-container {
            margin-top: 30px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">View Messages</h1>
            <p class="lead">List of all messages submitted through the contact form</p>
        </div>
    </div>

    <!-- Messages Section -->
    <div class="container py-5">
        <div class="messages-container">
            <h2>Contact Messages</h2>
            <?php
            // Fetch messages from the database
            $sql = "SELECT  name, email, phone, message, submitted_at FROM contact_messages ORDER BY submitted_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='table-container'>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='table-light'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                echo "<th>Message</th>";
                echo "<th>Submitted At</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['submitted_at']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning mt-4'>No messages found.</div>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>