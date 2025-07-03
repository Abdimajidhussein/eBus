<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Pacific Coach</h3>
                <p>Your reliable partner for safe, comfortable, and affordable bus travel across Kenya. We also deliver your parcels on time.</p>
            </div>

            <div class="footer-column">
                <h3>Quick Links</h3>
                <p><a href="index.php">Home</a></p>
                <p><a href="view_schedules.php">View Schedules</a></p>
                <p><a href="my_bookings.php">My Bookings</a></p>
                <p><a href="about.php">About Us</a></p>
                <p><a href="contact.php">Contact</a></p>
            </div>

            <div class="footer-column">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> Mombasa, Kenya</p>
                <p><i class="fas fa-phone"></i> +254 712 345 678</p>
                <p><i class="fas fa-envelope"></i> support@pacificcoach.co.ke</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <script>document.write(new Date().getFullYear());</script> Pacific Coach. All rights reserved.
        </div>
    </footer>

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
            padding: 0;
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* FOOTER */
        .footer {
            background: var(--primary-color);
            color: var(--white);
            /* SIGNIFICANTLY Reduced padding to shrink height */
            padding: 20px 15px 10px; /* Further reduced from previous 25px 20px 15px */
        }

        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Slightly reduced min-width for columns */
            gap: 15px; /* Further reduced gap between columns */
        }

        .footer h3 {
            font-size: 1em; /* Further reduced font size for headings */
            margin-bottom: 8px; /* Further reduced margin */
        }

        .footer p, .footer a {
            color: #ddd;
            font-size: 0.85em; /* Further reduced font size for text */
            line-height: 1.4; /* Further reduced line height */
            margin-bottom: 3px; /* Further reduced margin-bottom for paragraph spacing */
        }

        .footer a:hover {
            color: var(--white);
        }

        .footer-column p:last-of-type {
            margin-bottom: 0;
        }

        .social-icons {
            margin-top: 8px; /* Further reduced margin */
        }

        .social-icons a {
            color: #ddd;
            margin-right: 10px; /* Further reduced spacing between icons */
            font-size: 16px; /* Further reduced icon size */
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--accent-color);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px; /* Further reduced margin */
            padding-top: 10px; /* Further reduced padding */
            border-top: 1px solid var(--primary-dark);
            font-size: 0.8em; /* Further reduced font size */
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .footer {
                padding: 15px 10px 8px; /* More aggressive reduction for tablets */
            }
            .footer-container {
                gap: 10px;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            .footer h3 {
                font-size: 0.95em;
                margin-bottom: 6px;
            }
            .footer p, .footer a {
                font-size: 0.8em;
                line-height: 1.3;
                margin-bottom: 2px;
            }
            .social-icons {
                margin-top: 5px;
            }
            .social-icons a {
                font-size: 14px;
                margin-right: 8px;
            }
            .footer-bottom {
                margin-top: 15px;
                padding-top: 8px;
                font-size: 0.75em;
            }
        }

        @media (max-width: 480px) {
            .footer {
                padding: 10px 8px 5px; /* Even more aggressive reduction for mobile */
            }
            .footer-container {
                gap: 8px;
                grid-template-columns: 1fr; /* Stack columns on very small screens */
            }
            .footer-column {
                text-align: center; /* Center content when stacked */
                margin-bottom: 15px; /* Add some space between stacked columns */
            }
            .footer-column:last-child {
                margin-bottom: 0;
            }
            .social-icons {
                text-align: center; /* Center social icons */
            }
            .footer h3 {
                font-size: 0.9em;
                margin-bottom: 5px;
            }
            .footer p, .footer a {
                font-size: 0.75em;
                line-height: 1.2;
                margin-bottom: 1px;
            }
            .social-icons a {
                font-size: 13px;
                margin-right: 6px;
            }
            .footer-bottom {
                margin-top: 10px;
                padding-top: 5px;
                font-size: 0.7em;
            }
        }
    </style>
</body>
</html>