<?php
include 'header.php';
include 'database.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if required fields are filled
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert data into the database
        $sql = "INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Your message has been sent successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Failed to send your message. Please try again later.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Please fill in all required fields.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us - Vehicle Assistance</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" >
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Custom Styles -->
    <style>
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .contact-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .btn-custom {
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Contact Us</h1>
        <p>We are here to assist you. Reach out to us anytime!</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="contact-card">
                <div class="card-body">
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please enter your name</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}">
                            <div class="invalid-feedback">Please enter a valid 10-digit phone number</div>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">Please enter your message</div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-custom w-100">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>

<?php include 'footer.php'; ?>