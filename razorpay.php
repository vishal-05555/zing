<?php
// razorpay.php
// This file will handle Razorpay API integration
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Integration</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function makePayment() {
            var options = {
                "key": "YOUR_API_KEY", // Enter the Key ID generated from the Razorpay Dashboard
                "amount": 50000, // Amount is in currency subunits. Default is paise. Hence 50000 means 50000 paise or ₹500.
                "currency": "INR",
                "name": "Vehicle Assistance",
                "description": "Payment for service",
                "handler": function (response) {
                    alert(response.razorpay_payment_id);
                },
                "prefill": {
                    "name": "Customer Name",
                    "email": "customer@example.com",
                    "contact": "9999999999"
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</head>
<body>
    <h1>Make a Payment</h1>
    <button onclick="makePayment()">Pay Now</button>
</body>
</html>
