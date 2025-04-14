<?php
require('vendor/autoload.php'); // Include Razorpay PHP SDK

use Razorpay\Api\Api;

// Razorpay API Key and Secret
$key_id = 'rzp_test_3SmUwA7tRKuBfu'; // Replace with your Razorpay Key ID
$key_secret = 'WJC271HERGhmq8DeBLfoFQ9M'; // Replace with your Razorpay Key Secret

// Create Razorpay Order
$api = new Api($key_id, $key_secret);

$orderData = [
    'receipt'         => 'order_rcptid_11',
    'amount'          => 50000, // Amount in paise (e.g., 50000 = ₹500)
    'currency'        => 'INR',
    'payment_capture' => 1 // Auto-capture payment
];

try {
    $order = $api->order->create($orderData); // Creates an order
    $order_id = $order['id']; // Get the order ID
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 24px;
            font-weight: 500;
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

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn i {
            font-size: 20px;
        }

        .footer {
            background-color: #f8f9fa;
            color: #555;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
            font-size: 14px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <i class="bi bi-credit-card"></i> Razorpay Payment
    </div>

    <!-- Payment Container -->
    <div class="container">
        <h1>Make a Payment</h1>
        <p class="text-muted mb-4">Secure and fast payment with Razorpay</p>
        <button class="btn" id="rzp-button">
            <i class="bi bi-wallet2"></i> Pay Now
        </button>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Your Company Name. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </div>

    <script>
        const options = {
            "key": "<?php echo $key_id; ?>", // Razorpay Key ID
            "amount": "50000", // Amount in paise (e.g., 50000 = ₹500)
            "currency": "INR",
            "name": "Your Company Name",
            "description": "Test Transaction",
            "order_id": "<?php echo $order_id; ?>", // Pass the order ID from PHP
            "handler": function (response) {
                // Handle successful payment
                alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                // Optionally, send the payment ID to your server for verification
                window.location.href = "payment_success.php?payment_id=" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "John Doe", // Optional: Prefill customer name
                "email": "john.doe@example.com", // Optional: Prefill customer email
                "contact": "9999999999" // Optional: Prefill customer phone
            },
            "theme": {
                "color": "#007bff" // Customize the theme color
            }
        };

        const rzp = new Razorpay(options);

        // Open Razorpay Checkout on button click
        document.getElementById('rzp-button').onclick = function (e) {
            rzp.open();
            e.preventDefault();
        };
    </script>
</body>
</html>