<?php
require('vendor/autoload.php'); // Include Razorpay PHP SDK

use Razorpay\Api\Api;

// Replace with your Razorpay Key ID and Secret
$key_id = 'rzp_test_3SmUwA7tRKuBfu';
$key_secret = 'WJC271HERGhmq8DeBLfoFQ9M';

$api = new Api($key_id, $key_secret);

// Create an order
$orderData = [
    'receipt'         => 'order_rcptid_11',
    'amount'          => 50000, // Amount in paise (e.g., 50000 = ₹500)
    'currency'        => 'INR',
    'payment_capture' => 1 // Auto-capture payment
];

try {
    $order = $api->order->create($orderData); // Creates an order
    $order_id = $order['id']; // Get the order ID
    echo json_encode(['order_id' => $order_id]); // Return the order ID as JSON
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>