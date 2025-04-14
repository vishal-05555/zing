<?php
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    echo "<h1>Payment Successful!</h1>";
    echo "<p>Payment ID: $payment_id</p>";
    // Optionally, verify the payment on the server side using Razorpay's API
} else {
    echo "<h1>Payment Failed!</h1>";
}
?>