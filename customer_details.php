<!-- filepath: c:\x2\htdocs\zing\customer_details.php -->
<?php
include 'header.php';
include 'database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already active
}

// Check if the email is submitted via the form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email']; // Set the email in the session
}

// Check if the user's email is stored in the session
if (!isset($_SESSION['email'])) {
    // Display the email input form if the email is not set
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <title>Set Email</title>
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center">Set Your Email</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Enter Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$customer_email = $_SESSION['email']; // Get the logged-in customer's email

// Fetch customer details from the database
$sql = "SELECT * FROM customers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc(); // Fetch customer details
} else {
    echo "<div class='alert alert-danger text-center'>Error: Customer details not found.</div>";
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
    <title>Customer Details</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Customer Details</h2>
        <div class="card mt-4">
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($customer['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="fuel_delivery.php" class="btn btn-primary">Back to Providers</a>
        </div>
    </div>
</body>
</html>