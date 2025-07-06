<?php
// Start session for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $_SESSION['username'] ?? '';

// Corrected logic for isAdmin
$isAdmin = ($_SESSION['user_type'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacific Coach - Seamless Journeys</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <?php include 'includes/header.php'; ?>

    <style>
        :root {
            --primary-color: #0F4C81;
            --primary-light: #1a5d9a;
            --primary-dark: #0A3763;
            --accent-color: #FF6F61;
            --accent-light: #ff8b81;
            --accent-dark: #e05e54;
            --text-color: #343a40;
            --light-gray: #f8f9fa;
            --mid-gray: #e9ecef;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-top: 135px; /* Based on your header.php styling previously provided (75px header + 60px navbar) */
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* HERO - Carousel */
        .hero-section {
            height: 400px;
            background-color: var(--primary-color);
            position: relative;
            overflow: hidden;
            margin-top: 139px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1;
        }

        .carousel-inner {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease-in-out; /* Smooth slide transition */
        }

        .carousel-item {
            min-width: 100%;
            height: 100%;
            background-size: cover; /* Ensures the image covers the entire area */
            background-position: center; /* Centers the image within the container */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            flex-shrink: 0;
        }

        .carousel-item-1 { background-image: url('images/pacific0.png'); }
        .carousel-item-2 { background-image: url('images/in3.jpeg'); }
        .carousel-item-3 { background-image: url('images/city-transport.jpg'); }
        .carousel-item-4 { background-image: url('images/bus-night.jpg'); }
        .carousel-item-5 { background-image: url('images/support2.jpg'); }

        /* If you added a duplicate for looping, add its style too */
        .carousel-item-clone-1 { background-image: url('images/pacific0.png'); }


        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 20px;
            box-sizing: border-box;
            color: var(--white);
        }

        .hero-content h2 {
            font-size: 3em;
            margin-bottom: 15px;
            color: var(--white);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }

        .hero-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: var(--white);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }

        /* Carousel Controls (Arrows) */
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.3);
            color: white;
            border: none;
            padding: 15px 10px;
            cursor: pointer;
            z-index: 3;
            font-size: 1.5em;
            transition: background 0.3s ease;
            border-radius: 5px;
        }

        .carousel-control:hover {
            background: rgba(0,0,0,0.6);
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        /* Carousel Indicators (Dots) */
        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: flex;
            gap: 10px;
        }

        .carousel-indicator-dot {
            width: 12px;
            height: 12px;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .carousel-indicator-dot.active {
            background: var(--accent-color);
            transform: scale(1.2);
        }


        /* BUTTONS */
        .btn {
            background-color: var(--accent-color);
            color: var(--white);
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            background-color: var(--accent-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* SECTIONS */
        .section-padding {
            padding: 60px 20px;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .section-title {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-size: 2.2em;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* CARDS */
        .featured-routes,
        .services-container,
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .route-card,
        .service-card,
        .feature-card {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .route-card:hover,
        .service-card:hover,
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .route-card-img-container {
            height: 180px;
            overflow: hidden;
        }

        .route-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .route-card:hover img {
            transform: scale(1.05);
        }

        .route-card-content {
            padding: 20px;
        }

        .route-card h3 {
            margin: 0 0 10px;
            color: var(--primary-color);
        }

        .route-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        .route-details i {
            color: var(--accent-color);
            margin-right: 5px;
        }

        .route-price {
            font-weight: 700;
            color: var(--accent-color);
            margin: 15px 0;
            font-size: 1.2em;
        }

        /* SERVICES */
        .service-card {
            padding: 30px;
            text-align: center;
        }

        .service-icon-container {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 76, 129, 0.1);
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 28px;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon-container {
            background: var(--accent-color);
            color: white;
        }

        .service-card h3 {
            font-size: 1.3em;
            margin-bottom: 15px;
            position: relative;
        }

        .service-card h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--accent-color);
        }

        /* FEATURES */
        .feature-card {
            padding: 25px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 76, 129, 0.1);
            border-radius: 10px;
            color: var(--primary-color);
            font-size: 22px;
        }

        .feature-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        /* STATS */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: var(--light-gray);
            border-radius: 8px;
        }

        .stat-number {
            font-size: 2.2em;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.9em;
            color: #555;
        }

        /* CTA */
        .cta-section {
            background: var(--primary-color);
            color: var(--white);
            border-radius: 8px;
            padding: 50px 20px;
            margin: 60px auto;
            max-width: 1000px;
            text-align: center;
            box-sizing: border-box;
        }

        .cta-section h2 {
            font-size: 2.2em;
            margin-bottom: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .hero-content h2 {
                font-size: 2.8em;
            }
            .hero-content p {
                font-size: 1.1em;
            }
            .section-title {
                font-size: 2em;
            }
            .section-subtitle {
                font-size: 0.95em;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 350px;
            }
            .hero-content h2 {
                font-size: 2.4em;
            }
            .hero-content p {
                font-size: 1em;
            }
            .section-padding {
                padding: 40px 15px;
            }
            .section-title {
                font-size: 1.8em;
            }
            .section-subtitle {
                margin-bottom: 30px;
            }
            .featured-routes,
            .services-container,
            .features-container {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
            .route-card-img-container {
                height: 160px;
            }
            .service-card, .feature-card {
                padding: 25px;
            }
            .cta-section {
                margin: 40px auto;
                padding: 40px 15px;
            }
            .cta-section h2 {
                font-size: 1.8em;
            }
            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
            .stat-number {
                font-size: 2em;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                height: 300px;
            }
            .hero-content h2 {
                font-size: 2em;
            }
            .hero-content p {
                font-size: 0.9em;
            }
            .btn {
                padding: 10px 20px;
                font-size: 0.9em;
            }
            .section-padding {
                padding: 30px 10px;
            }
            .section-title {
                font-size: 1.6em;
            }
            .section-subtitle {
                font-size: 0.85em;
                margin-bottom: 25px;
            }
            .featured-routes,
            .services-container,
            .features-container {
                grid-template-columns: 1fr; /* Stack cards on very small screens */
                gap: 15px;
            }
            .route-card-img-container {
                height: 150px;
            }
            .route-card-content, .service-card, .feature-card {
                padding: 20px;
            }
            .route-price {
                font-size: 1.1em;
            }
            .service-icon-container {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            .feature-icon {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }
            .cta-section {
                padding: 30px 10px;
            }
            .cta-section h2 {
                font-size: 1.6em;
            }
            .stats-container {
                grid-template-columns: repeat(2, 1fr); /* Two columns for stats on small phones */
                gap: 15px;
            }
            .stat-number {
                font-size: 1.8em;
            }
            .stat-label {
                font-size: 0.8em;
            }
        }

        @media (max-width: 380px) {
            .hero-content h2 {
                font-size: 1.6em;
            }
            .hero-content p {
                font-size: 0.8em;
            }
            .section-title {
                font-size: 1.4em;
            }
            .route-card-content h3 {
                font-size: 1.1em;
            }
            .service-card h3 {
                font-size: 1.2em;
            }
            .feature-title {
                font-size: 1.1em;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="carousel-inner" id="carouselInner">
            <div class="carousel-item carousel-item-1">
                <div class="hero-content">
                    <h2>Your Journey Starts Here</h2>
                    <p>Providing safe, reliable, and comfortable bus travel across Mombasa County and beyond.</p>
                    <a href="view_schedules.php" class="btn">Explore Our Routes</a>
                </div>
            </div>
            <div class="carousel-item carousel-item-2">
                <div class="hero-content">
                    <h2>Modern Fleet, Unmatched Comfort</h2>
                    <p>Experience luxurious travel with Wi-Fi, reclining seats, and spacious interiors.</p>
                    <a href="about.php" class="btn">Learn More</a>
                </div>
            </div>
            <div class="carousel-item carousel-item-3">
                <div class="hero-content">
                    <h2>Book With Ease, Travel With Peace</h2>
                    <p>Our online booking system makes planning your trip simple and stress-free.</p>
                    <a href="my_bookings.php" class="btn">Manage Bookings</a>
                </div>
            </div>
            <div class="carousel-item carousel-item-4">
                <div class="hero-content">
                    <h2>Connecting You to Your Destination</h2>
                    <p>With an extensive network, we cover major towns and cities across the region.</p>
                    <a href="view_schedules.php" class="btn">View All Routes</a>
                </div>
            </div>
            <div class="carousel-item carousel-item-5">
                <div class="hero-content">
                    <h2>24/7 Support for Your Peace of Mind</h2>
                    <p>Our dedicated support team is always available to assist you, day or night.</p>
                    <a href="contact.php" class="btn">Contact Support</a>
                </div>
            </div>
            <div class="carousel-item carousel-item-clone-1">
                <div class="hero-content">
                    <h2>Your Journey Starts Here</h2>
                    <p>Providing safe, reliable, and comfortable bus travel across Mombasa County and beyond.</p>
                    <a href="view_schedules.php" class="btn">Explore Our Routes</a>
                </div>
            </div>
        </div>

        <button class="carousel-control carousel-control-prev" onclick="plusSlides(-1)">&#10094;</button>
        <button class="carousel-control carousel-control-next" onclick="plusSlides(1)">&#10095;</button>

        <div class="carousel-indicators" id="carouselIndicators">
            <span class="carousel-indicator-dot active" onclick="currentSlide(1)"></span>
            <span class="carousel-indicator-dot" onclick="currentSlide(2)"></span>
            <span class="carousel-indicator-dot" onclick="currentSlide(3)"></span>
            <span class="carousel-indicator-dot" onclick="currentSlide(4)"></span>
            <span class="carousel-indicator-dot" onclick="currentSlide(5)"></span>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="section-padding">
            <h2 class="section-title">Popular Destinations</h2>
            <p class="section-subtitle">Explore our most traveled routes with comfort and reliability</p>

            <div class="featured-routes">
                <div class="route-card">
                    <div class="route-card-img-container">
                        <img src="images/msa.jpeg" alt="Mombasa Old Town">
                    </div>
                    <div class="route-card-content">
                        <h3>Mombasa to Garissa</h3>
                        <div class="route-details">
                            <span><i class="fas fa-clock"></i> 8h 30m</span>
                            <span><i class="fas fa-bus"></i> 2 daily trips</span>
                        </div>
                        <div class="route-price">From KES 1,200</div>
                        <a href="view_schedules.php?route=mombasa-garissa" class="btn">Book Now</a>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-card-img-container">
                        <img src="images/gsa.jpg" alt="Garissa">
                    </div>
                    <div class="route-card-content">
                        <h3>Garissa to Mombasa</h3>
                        <div class="route-details">
                            <span><i class="fas fa-clock"></i> 8h 15m</span>
                            <span><i class="fas fa-bus"></i> 3 daily trips</span>
                        </div>
                        <div class="route-price">From KES 1,200</div>
                        <a href="view_schedules.php?route=garissa-mombasa" class="btn">Book Now</a>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-card-img-container">
                        <img src="images/mld.jpeg" alt="Malindi Beach">
                    </div>
                    <div class="route-card-content">
                        <h3>Garissa to Malindi</h3>
                        <div class="route-details">
                            <span><i class="fas fa-clock"></i> 6h 45m</span>
                            <span><i class="fas fa-bus"></i> 1 daily trip</span>
                        </div>
                        <div class="route-price">From KES 1,500</div>
                        <a href="view_schedules.php?route=garissa-malindi" class="btn">Book Now</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding" style="background: #f8f9fa;">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">We go beyond transportation to provide comprehensive travel solutions</p>

            <div class="services-container">
                <div class="service-card">
                    <div class="service-icon-container">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Parcel Delivery</h3>
                    <p>Fast, secure, and affordable parcel delivery across our entire bus network. Your package is our priority with real-time tracking available.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon-container">
                        <i class="fas fa-bus-alt"></i>
                    </div>
                    <h3>Premium Fleet</h3>
                    <p>Modern and comfortable buses equipped with Wi-Fi, charging ports, air conditioning, and more for your smooth journey.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon-container">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3>Extensive Network</h3>
                    <p>We connect major towns and cities across the country with reliable daily departures. Check our latest route schedules.</p>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <h2 class="section-title">Why Choose Pacific Coach?</h2>
            <p class="section-subtitle">Convenient, Fast and Reliable - Your journey is our commitment</p>

            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="feature-title">Save Money</h3>
                    <p class="feature-description">
                        Pay less when using our new Mobile App. You can save up to 25% of your Promo Cash balance in a single purchase.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3 class="feature-title">Earn Rewards</h3>
                    <p class="feature-description">
                        Receive more credit during promotional periods which will be added into your Promo Cash account.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="feature-title">Multiple Routes</h3>
                    <p class="feature-description">
                        We cover multiple routes and the widest connectivity in Kenya, Uganda, Rwanda and Tanzania.
                    </p>
                </div>
            </div>

            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Modern Buses</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Destinations</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">On-time Performance</div>
                </div>
            </div>
        </section>
    </div>

    <div class="cta-section">
        <h2>Ready to Book Your Next Journey?</h2>
        <p>While we don't offer direct search on this page, you can easily view all available schedules and manage your existing bookings.</p>
        <a href="view_schedules.php" class="btn">View All Schedules</a>
    </div>
    <?php include 'includes/footer.php'; ?>

    <script>
        let slideIndex = 0; // Current actual slide index (0 to 4 for 5 slides)
        let totalSlides = 5; // Number of actual slides
        let carouselInner;
        let slides;
        let dots;
        let autoSlideTimeout; // Use setTimeout for clearer control than setInterval

        function initializeCarousel() {
            carouselInner = document.getElementById('carouselInner');
            slides = document.querySelectorAll(".carousel-item:not(.carousel-item-clone-1)"); // Get only original slides
            dots = document.getElementsByClassName("carousel-indicator-dot");

            // Position to the first slide (which is technically the first clone in the transform logic)
            // The initial transform should be -100% to show the first actual slide if clones are at start
            // But with clone at end, we start at 0 and transition to -100% for the next
            showSlide(slideIndex, false); // Show first slide immediately, no transition
            startAutoSlide();
        }

        function showSlide(index, useTransition = true) {
            // Adjust the transform property
            if (useTransition) {
                carouselInner.style.transition = 'transform 0.5s ease-in-out';
            } else {
                carouselInner.style.transition = 'none'; // Disable transition for instant jump
            }

            carouselInner.style.transform = 'translateX(' + (-index * 100) + '%)';

            // Update active dot
            // The dots correspond to the actual slides, not the clone
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove('active');
            }
            if (index < totalSlides) { // Only update dot for non-clone slides
                 dots[index].classList.add('active');
            } else {
                // If it's the clone, highlight the first dot
                dots[0].classList.add('active');
            }
        }

        function plusSlides(n) {
            clearTimeout(autoSlideTimeout); // Stop auto-slide on manual interaction

            slideIndex += n;

            // Handle looping for forward movement
            if (slideIndex > totalSlides) { // If going past the last actual slide (and into the clone)
                // Temporarily show the clone with transition
                showSlide(slideIndex);
                // After the transition, instantly jump back to the first real slide
                setTimeout(() => {
                    slideIndex = 0;
                    showSlide(slideIndex, false); // No transition for the jump
                }, 500); // Must match CSS transition duration
            }
            // Handle looping for backward movement (optional, but good for completeness)
            else if (slideIndex < 0) {
                // If moving backwards from the first slide, jump to the last real slide
                slideIndex = totalSlides - 1;
                showSlide(slideIndex, false); // No transition for the jump
            }
            else {
                showSlide(slideIndex); // Normal slide transition
            }

            startAutoSlide(); // Restart auto-slide
        }

        function currentSlide(n) {
            clearTimeout(autoSlideTimeout); // Stop auto-slide on manual interaction
            slideIndex = n - 1; // n is 1-based, slideIndex is 0-based
            showSlide(slideIndex);
            startAutoSlide(); // Restart auto-slide
        }

        function autoAdvanceSlides() {
            slideIndex++; // Advance to the next slide
            if (slideIndex >= totalSlides) {
                // When we are about to move to the clone, apply transition for the clone first
                showSlide(slideIndex);
                // Then, after the transition, quickly reset to the real first slide (index 0)
                autoSlideTimeout = setTimeout(() => {
                    slideIndex = 0;
                    showSlide(slideIndex, false); // No transition for the jump back
                    autoSlideTimeout = setTimeout(autoAdvanceSlides, 5000); // Start next auto-advance
                }, 500); // This delay should match the CSS transition duration
            } else {
                showSlide(slideIndex);
                autoSlideTimeout = setTimeout(autoAdvanceSlides, 5000); // Continue auto-advancing
            }
        }

        function startAutoSlide() {
            clearTimeout(autoSlideTimeout); // Clear any existing timer
            autoSlideTimeout = setTimeout(autoAdvanceSlides, 5000); // Start auto-advancing every 5 seconds
        }


        // Initialize the carousel when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', initializeCarousel);
    </script>
</body>
</html>