<!-- filepath: c:\x2\htdocs\zing\user_register.php -->
<?php
session_start(); // Start the session at the very top of the file
?>
<?php include 'header.php'; ?>
<?php


$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Register</h1>
            <p class="lead mb-4">Create your account to access all features.</p>
        </div>
    </div>

    <!-- Registration Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4 text-center">Create an Account</h2>

                        <!-- Display Error Message -->
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process_register.php" class="needs-validation" novalidate>
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
                            <button type="submit" class="btn btn-custom w-100">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                        </form>

                        <!-- Already a Member -->
                        <div class="text-center mt-3">
                            <p>Already a member? <a href="login.php" class="text-primary">Login here</a></p>
                        </div>
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

    <style>
        .btn-custom {
            background-color: rgb(70, 162, 223); /* Custom blue color */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .btn-custom:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }

        .toggle-password {
            color: #6c757d;
        }

        .toggle-password:hover {
            color: #495057;
        }
    </style>

<?php include 'footer.php'; ?>
</body>
</html>