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
            /* Remove fixed padding-top; header/navbar should be handled by their own positioning (e.g., fixed/sticky) */
            padding-top: 0; 
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* HERO */
        .hero-section {
            height: 400px;
            background: var(--primary-color) url('images/pacific0.png') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            /* Adjust margin-top to account for the included header's height if it's not absolutely/fixed positioned */
            margin-top: 0; /* Assuming header is handled by 'includes/header.php' and is positioned independently or body padding is not needed */
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
        }

        .hero-content h2 {
            font-size: 3em;
            margin-bottom: 15px;
            color: var(--white);
        }

        .hero-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: var(--white);
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
            padding: 0 20px; /* Consistent padding for content wrapper */
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Adjusted minmax for smaller screens */
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
            box-sizing: border-box; /* Include padding in width */
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
        <div class="hero-content">
            <h2>Your Journey Starts Here</h2>
            <p>Providing safe, reliable, and comfortable bus travel across Mombasa County and beyond.</p>
            <a href="view_schedules.php" class="btn">Explore Our Routes</a>
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

</body>
</html>