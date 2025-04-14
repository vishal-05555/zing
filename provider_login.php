<?php
// filepath: c:\x2\htdocs\zing\provider_login.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'database.php'; // Include database connection

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $company_name = htmlspecialchars(trim($_POST['company_name']));
    $license_number = htmlspecialchars(trim($_POST['license_number']));

    // Query to check provider credentials
    $sql = "SELECT * FROM service_providers WHERE company_name = ? AND license = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $company_name, $license_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $provider = $result->fetch_assoc();

        // Provider authenticated
        $_SESSION['provider_logged_in'] = true;
        $_SESSION['provider_id'] = $provider['id'];
        $_SESSION['provider_name'] = $provider['company_name']; // Store provider name
        $_SESSION['provider_license'] = $provider['license']; // Store provider license
        header('Location: provider_dashboard.php'); // Redirect to provider dashboard
        exit;
    } else {
        $error = "Invalid Company Name or License Number.";
    }
}
?>

<?php include 'header.php'; ?> <!-- Include header after PHP logic -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Provider Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .login-container h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #3498db;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .alert-danger {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="login-container">
            <h3>Provider Login</h3>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name" required>
                </div>
                <div class="mb-3">
                    <label for="license_number" class="form-label">License Number</label>
                    <input type="text" class="form-control" id="license_number" name="license_number" placeholder="Enter your license number" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>