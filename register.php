<?php
// register.php
include 'database.php';
include 'header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $companyName = htmlspecialchars(trim($_POST['company_name']));
    $license = htmlspecialchars(trim($_POST['license']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $location = htmlspecialchars(trim($_POST['location']));
    $bankAccount = htmlspecialchars(trim($_POST['bank_account']));
    $serviceProvided = htmlspecialchars(trim($_POST['service_provided']));

    // Server-side validation
    if (empty($companyName) || empty($license) || empty($phone) || empty($location) || empty($bankAccount) || empty($serviceProvided)) {
        $error = 'All fields are required.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error = 'Phone number must be a valid 10-digit number.';
    } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $license)) {
        $error = 'License number must contain only letters, numbers, and spaces.';
    } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $bankAccount)) {
        $error = 'Bank account details must contain only letters, numbers, and spaces.';
    } else {
        // Insert into database
        $sql = "INSERT INTO service_providers (company_name, license, phone, location, bank_account, service_provided) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $companyName, $license, $phone, $location, $bankAccount, $serviceProvided);

        if ($stmt->execute()) {
            $success = 'Registration successful!';
        } else {
            $error = 'An error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Service Provider Registration</title>
    <style>
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .registration-card {
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
            <h1 class="display-4">Register as a Service Provider</h1>
            <p class="lead">Join our platform to provide your services to customers</p>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="registration-card">
                    <h2 class="text-center mb-4">Service Provider Registration</h2>

                    <!-- Display Success or Error Message -->
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php elseif ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="" class="needs-validation" novalidate>
                        <!-- Company Name -->
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name *</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name" required>
                            <div class="invalid-feedback">Please enter your company name</div>
                        </div>

                        <!-- License Number -->
                        <div class="mb-3">
                            <label for="license" class="form-label">License Number *</label>
                            <input type="text" class="form-control" id="license" name="license" placeholder="Enter your license number" required>
                            <div class="invalid-feedback">Please enter your license number</div>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">Please enter a valid 10-digit phone number</div>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
                            <div class="invalid-feedback">Please enter your location</div>
                        </div>

                        <!-- Bank Account -->
                        <div class="mb-3">
                            <label for="bank_account" class="form-label">Bank Account *</label>
                            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Enter your bank account details" required>
                            <div class="invalid-feedback">Please enter your bank account details</div>
                        </div>

                        <!-- Service Provided -->
                        <div class="mb-3">
                            <label for="service_provided" class="form-label">Service Provided *</label>
                            <input type="text" class="form-control" id="service_provided" name="service_provided" placeholder="Enter the service you provide" required>
                            <div class="invalid-feedback">Please enter the service you provide</div>
                        </div>
                        <div class="mb-3 text-center">
    <p>Already registered? <a href="provider_login.php">Login here</a></p>
</div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-custom w-100">Register</button>
                    </form>
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
</body>
</html>
<?php include 'footer.php'; ?>