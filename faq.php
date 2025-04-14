<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Vehicle Assistance</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Custom Styles -->
    <style>
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            position: relative;
            overflow: hidden;
            padding: 4rem 0;
            color: white;
            text-align: center;
        }

        .accordion-button {
            background-color: #3498db;
            color: white;
        }

        .accordion-button:not(.collapsed) {
            background-color: #2980b9;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            background-color: #f8f9fa;
        }

        .faq-item {
            margin-bottom: 1rem;
        }

        .faq-item h5 {
            color: #3498db;
        }

        .faq-item p {
            margin-bottom: 0.5rem;
        }

        .text-center a {
            color: #3498db;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Frequently Asked Questions</h1>
            <p class="lead mb-4">Find answers to common questions about our services.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="text-center mb-5">Frequently Asked Questions</h1>

        <!-- Search Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="faqSearch" placeholder="Search FAQs...">
                </div>
            </div>
        </div>

        <!-- FAQ Accordion -->
        <div class="accordion" id="faqAccordion">
            <!-- General Questions -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#generalQuestions">
                        <i class="fas fa-info-circle me-2"></i>General Questions
                    </button>
                </h2>
                <div id="generalQuestions" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <div class="faq-item">
                            <p>We are a platform that connects vehicle owners with professional service providers for emergency roadside assistance. Our services include tire puncture repair, fuel delivery, towing, and more.</p>
                        </div>
                        <div class="faq-item">
                            <h5>How does it work?</h5>
                            <p>Simply sign up, request a service through our platform, and we'll connect you with nearby service providers. You can track their arrival in real-time and pay securely through our platform.</p>
                        </div>
                        <div class="faq-item">
                            <h5>Is the service available 24/7?</h5>
                            <p>Yes, our services are available 24 hours a day, 7 days a week, including holidays.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#servicesQuestions">
                        <i class="fas fa-tools me-2"></i>Our Services
                    </button>
                </h2>
                <div id="servicesQuestions" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <div class="faq-item">
                            <h5>What services do you offer?</h5>
                            <ul>
                                <li>Tire puncture repair/replacement</li>
                                <li>Emergency fuel delivery</li>
                                <li>Vehicle towing</li>
                                <li>Battery jump-start</li>
                                <li>Key replacement</li>
                                <li>Basic mechanical repairs</li>
                            </ul>
                        </div>
                        <div class="faq-item">
                            <h5>How long does it take for help to arrive?</h5>
                            <p>Service providers typically arrive within 30-45 minutes, depending on your location and traffic conditions. You can track their real-time location through our platform.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pricingQuestions">
                        <i class="fas fa-rupee-sign me-2"></i>Pricing & Payment
                    </button>
                </h2>
                <div id="pricingQuestions" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <div class="faq-item">
                            <h5>How much do services cost?</h5>
                            <p>Prices vary depending on the service and your location. You'll see the base price before confirming your request, and any additional charges will be discussed with you beforehand.</p>
                        </div>
                        <div class="faq-item">
                            <h5>What payment methods do you accept?</h5>
                            <ul>
                                <li>Credit/Debit cards</li>
                                <li>UPI payments</li>
                                <li>Net banking</li>
                                <li>Cash</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Providers -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#providerQuestions">
                        <i class="fas fa-user-tie me-2"></i>Service Providers
                    </button>
                </h2>
                <div id="providerQuestions" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <div class="faq-item">
                            <h5>How do you select service providers?</h5>
                            <p>All service providers undergo thorough background checks and must provide valid certifications. We regularly monitor their performance and maintain high quality standards.</p>
                        </div>
                        <div class="faq-item">
                            <h5>Can I become a service provider?</h5>
                            <p>Yes! If you're a qualified mechanic or service provider, you can join our platform. Visit our Provider Registration page to learn more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center mt-5">
            <p class="mb-3">Didn't find what you're looking for?</p>
            <a href="contact.php" class="btn btn-primary">
                <i class="fas fa-envelope me-2"></i>Contact Support
            </a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>