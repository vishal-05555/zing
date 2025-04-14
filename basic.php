<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer via Composer
include 'database.php'; // Include database connection
include 'header.php'; // Include header

// Ensure session is started only if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action']; // 'accept' or 'reject'

    // Fetch provider details
    $provider_id = $_SESSION['provider_id'];
    $provider_sql = "SELECT company_name, phone, location FROM service_providers WHERE id = ?";
    $provider_stmt = $conn->prepare($provider_sql);
    $provider_stmt->bind_param("i", $provider_id);
    $provider_stmt->execute();
    $provider_result = $provider_stmt->get_result();
    $provider = $provider_result->fetch_assoc();

    // Fetch service request details
    $request_sql = "SELECT customer_name, customer_email, service FROM service_requests WHERE id = ?";
    $request_stmt = $conn->prepare($request_sql);
    $request_stmt->bind_param("i", $request_id);
    $request_stmt->execute();
    $request_result = $request_stmt->get_result();
    $request = $request_result->fetch_assoc();

    // Determine the status based on the action
    if ($action === 'accept') {
        $status = 'Accepted';
        $email_subject = "Service Request Accepted";
        $email_body = "Dear {$request['customer_name']},\n\nYour service request for '{$request['service'] }' has been accepted by {$provider['company_name'] 
        
        }.\n\nPhone: {$provider['phone']}\nLocation: {$provider['location']}\n\nThank you for using our service!";
    } elseif ($action === 'reject') {
        $status = 'Rejected';
        $email_subject = "Service Request Rejected";
        
$email_body = "Dear {$request['customer_name']},\n\nYour service request for '{$request['service']}' has been accepted by {$provider['company_name']}.\n\nPhone: {$provider['phone']}\nLocation: {$provider['location']}\n\nThank you for using our service!";
    }

    // Update the status of the service request
    $update_sql = "UPDATE service_requests SET status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $status, $request_id);
    $update_stmt->execute();

    // Send email to the customer
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'vishalvenkat05@gmail.com'; // Your Gmail address
        $mail->Password = 'smzt ajqv xrwc bkxr'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('vishalvenkat05@gmail.com', 'Vehicle Assistance');
        $mail->addAddress($request['customer_email']);
        $mail->Subject = $email_subject;
        $mail->Body = $email_body;
    
        $mail->send();
        $_SESSION['message'] = 'Message sent to the customer!';
    } catch (Exception $e) {
        $_SESSION['message'] = "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If the request method is not POST, redirect to the dashboard
    header('Location: provider_dashboard.php');
    exit;
}

// Close the database connection    
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Processing Request</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message {
            font-size: 18px;
            color: #555;
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message <?php echo strpos($_SESSION['message'], 'Error') === false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
            </p>
            <?php unset($_SESSION['message']); ?>
        <?php else: ?>
            <p class="message">Processing your request...</p>
        <?php endif; ?>
        <a href="provider_dashboard.php" class="btn btn-primary">Go Back to Dashboard</a>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>