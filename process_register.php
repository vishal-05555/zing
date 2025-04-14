<!-- filepath: c:\x2\htdocs\zing\process_register.php -->
<?php
include("database.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: user_register.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check for duplicate email or phone
    $check_sql = "SELECT id FROM users WHERE email = ? OR phone = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If duplicate found, set error message and redirect back
        $_SESSION['error'] = 'Email or phone number is already registered.';
        header('Location: user_register.php');
        exit();
    }

    // Insert the user into the database
    $insert_sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful, redirect to thank_you.php
        $_SESSION['registration_success'] = true;
        header('Location: thank_you.php');
        exit();
    } else {
        // If an error occurs during insertion
        $_SESSION['error'] = 'An error occurred. Please try again.';
        header('Location: user_register.php');
        exit();
    }
}
?>