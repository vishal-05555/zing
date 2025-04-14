<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-4 fw-bold">Vehicle Assistance</h5>
                <p class="mb-3">Your trusted partner for 24/7 emergency vehicle assistance. We provide quick and reliable services for all your vehicle needs.</p>
                <div class="social-icons d-flex gap-3 mb-4">
                    <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
                </div>
                <p class="mb-0"><i class="fas fa-phone-alt me-2"></i> Emergency: +1 (800) 123-4567</p>
            </div>
         <!-- Quick Links -->
         <div class="col-md-2 mb-4">
                <h5 class="mb-4 fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="index.php" class="text-decoration-none text-white-50 hover-white"><i class="fas fa-home me-2"></i>Home</a></li>
                    <li class="mb-2"><a href="services.php" class="text-decoration-none text-white-50 hover-white"><i class="fas fa-concierge-bell me-2"></i>Services</a></li>
                    <li class="mb-2"><a href="about_us.php" class="text-decoration-none text-white-50 hover-white"><i class="fas fa-info-circle me-2"></i>About Us</a></li>
                    <li class="mb-2"><a href="faq.php" class="text-decoration-none text-white-50 hover-white"><i class="fas fa-question-circle me-2"></i>FAQ</a></li>
                    <li class="mb-2"><a href="contact_us.php" class="text-decoration-none text-white-50 hover-white"><i class="fas fa-envelope me-2"></i>Contact Us</a></li>
                </ul>
            </div>

            <!-- Our Services -->
            <div class="col-md-2 mb-4">
                <h5 class="mb-4 fw-bold">Our Services</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href= 'razorpay_payment.php'class="text-decoration-none text-white-50 hover-white"><i class="fas fa-car-crash me-2"></i>Tire Puncture</></li>
                    <li class="mb-2"><a  class="text-decoration-none text-white-50 hover-white"><i class="fas fa-key me-2"></i>Key Lost Service</a></li>
                    <li class="mb-2"><a  class="text-decoration-none text-white-50 hover-white"><i class="fas fa-tools me-2"></i>Mechanical Help</a></li>
                    <li class="mb-2"><a  class="text-decoration-none text-white-50 hover-white"><i class="fas fa-gas-pump me-2"></i>Petrol Refuelling</a></li>
                    <li class="mb-2"><a  class="text-decoration-none text-white-50 hover-white"><i class="fas fa-truck me-2"></i>Tow Service</a></li>
                    <li class="mb-2"><a  class="text-decoration-none text-white-50 hover-white"><i class="fas fa-battery-full me-2"></i>Battery Service</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-4 fw-bold">Subscribe to Our Newsletter</h5>
                <p class="mb-3">Stay updated with our latest services and offers.</p>
                <form action="subscribe.php" method="post" class="mb-4">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
                <div class="download-app">
                    <h6 class="mb-3">Download Our App</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm"><i class="fab fa-google-play me-2"></i>Google Play</a>
                        <a href="#" class="btn btn-outline-light btn-sm"><i class="fab fa-apple me-2"></i>App Store</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Bottom Footer -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Vehicle Assistance. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="privacy_policy.php" class="text-decoration-none text-white-50">Privacy Policy</a></li>
                    <li class="list-inline-item mx-3"><a href="terms.php" class="text-decoration-none text-white-50">Terms of Service</a></li>
                    <li class="list-inline-item"><a href="sitemap.php" class="text-decoration-none text-white-50">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" class="back-to-top btn btn-primary rounded-circle" id="back-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<!-- Add this to your CSS -->
<style>
    .hover-white:hover {
        color: white !important;
        transition: color 0.3s ease;
    }
    
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        padding: 0;
        z-index: 99;
    }
</style>

<!-- Back to Top Script -->
<script>
    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    
    // Scroll to top on click
    $('#back-to-top').click(function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });
</script>

</body>
</html>