<!-- filepath: c:\x2\htdocs\zing\user_registration.php -->
<?php
include("database.php");

session_start();

$error = '';
$success = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error = 'Please enter a valid 10-digit phone number.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        try {
            // Check for duplicate email or phone
            $check_sql = "SELECT id FROM users WHERE email = ? OR phone = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("ss", $email, $phone);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = 'Email or phone number is already registered.';
            } else {
                // Register user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

                if ($stmt->execute()) {
                    $success = 'Registration successful! You can now login.';
                } else {
                    $error = 'An error occurred while registering. Please try again later.';
                }
            }
        } catch (Exception $e) {
            $error = 'An unexpected error occurred: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4 text-center">Register</h2>

                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                            <div class="text-center">
                                <a href="user_login.php" class="btn btn-primary">Login Now</a>
                            </div>
                        <?php else: ?>
                            <form method="POST" action="" class="needs-validation" novalidate>
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces" required>
                                    <div class="invalid-feedback">Please enter your full name (letters and spaces only).</div>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" title="Phone number must be 10 digits" required>
                                    <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                                <!-- Password -->
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Password *</label>
                                    <input type="password" class="form-control" id="password" name="password" pattern=".{8,}" title="Password must be at least 8 characters long" required>
                                    <button class="btn btn-outline-secondary position-absolute" type="button" id="togglePassword" style="top: 38px; right: 15px;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Please enter a password (at least 8 characters).</div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3 position-relative">
                                    <label for="confirm_password" class="form-label">Confirm Password *</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <button class="btn btn-outline-secondary position-absolute" type="button" id="toggleConfirmPassword" style="top: 38px; right: 15px;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Passwords must match.</div>
                                </div>

                                <!-- Agree to Terms -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agree_terms" name="agree_terms" required>
                                    <label class="form-check-label" for="agree_terms">
                                        I agree to the <a href="terms.php" target="_blank" class="text-primary">Terms of Service</a> and 
                                        <a href="privacy_policy.php" target="_blank" class="text-primary">Privacy Policy</a>.
                                    </label>
                                    <div class="invalid-feedback">You must agree to the terms and privacy policy to register.</div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </form>
                        <?php endif; ?>
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

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirm_password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
    </script>
</body>
</html>