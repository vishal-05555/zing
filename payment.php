<?php
// payment.php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $providerId = $_POST['provider_id'];
    $customerId = $_POST['customer_id'];

    // Process payment logic here (e.g., integrate Razorpay API)

    echo "Payment of $amount processed successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Payment</title>
</head>
<body>
    <h1>Make a Payment</h1>
    <form method="POST" action="">
        <input type="text" name="amount" placeholder="Amount" required>
        <input type="text" name="provider_id" placeholder="Provider ID" required>
        <input type="text" name="customer_id" placeholder="Customer ID" required>
        <button type="submit">Pay</button>
    </form>
</body>
</html>
