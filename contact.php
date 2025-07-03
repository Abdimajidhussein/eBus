<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pacific Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php include 'includes/header.php'; ?>

    <style>
        :root {
            /* Professional Blue Palette */
            --primary-color: #0F4C81; /* Deep, professional blue */
            --primary-dark: #0A3763; /* Even darker blue for subtle contrast */
            --accent-color: #FF6F61; /* A muted, yet warm orange/coral for highlights */
            --text-color: #343a40; /* Darker gray for main text */
            --light-gray: #f8f9fa; /* Very light background for sections */
            --mid-gray: #e9ecef; /* Slightly darker gray for borders/dividers */
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

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
            display: flex;
            flex-wrap: wrap;
            gap: 30px; /* Space between columns */
        }

        h2.section-title {
            width: 100%; /* Make title span full width */
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        h2.section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .contact-info, .contact-form-section {
            flex: 1; /* Allow columns to grow */
            min-width: 300px; /* Minimum width before wrapping */
        }

        .contact-info {
            padding-right: 20px; /* Space between info and form */
        }

        .contact-info h3, .contact-form-section h3 {
            color: var(--primary-color);
            font-size: 1.8em;
            margin-top: 0; /* Remove default top margin */
            margin-bottom: 20px;
        }

        .contact-info p {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1.05em;
        }

        .contact-info p i {
            color: var(--accent-color);
            margin-right: 15px;
            font-size: 1.3em;
            width: 25px; /* Fixed width for icon to align text */
            text-align: center;
        }

        .social-icons {
            margin-top: 25px;
        }

        .social-icons a {
            color: var(--primary-dark);
            margin-right: 15px;
            font-size: 1.8em;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        /* Contact Form Styles */
        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--mid-gray);
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            box-sizing: border-box; /* Include padding in width */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-form input[type="text"]:focus,
        .contact-form input[type="email"]:focus,
        .contact-form textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(15, 76, 129, 0.2);
            outline: none;
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 120px;
        }

        .contact-form button {
            background-color: var(--accent-color);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%; /* Full width button */
        }

        .contact-form button:hover {
            background-color: #e05e54;
            transform: translateY(-2px);
        }

        .map-section {
            width: 100%; /* Map spans full width below columns */
            margin-top: 30px;
        }

        .map-section h3 {
            color: var(--primary-color);
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }

        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            position: relative;
            height: 0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
            border: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack columns on smaller screens */
                padding: 20px;
            }
            .contact-info, .contact-form-section {
                min-width: unset; /* Remove min-width to allow full stacking */
                width: 100%;
                padding-right: 0;
            }
            .contact-info {
                margin-bottom: 30px; /* Space between info and form when stacked */
            }
            h2.section-title {
                font-size: 2em;
            }
            .contact-info h3, .contact-form-section h3, .map-section h3 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="section-title">Contact Pacific Coach</h2>

        <div class="contact-info">
            <h3>Get in Touch</h3>
            <p><i class="fas fa-map-marker-alt"></i> Our Main Office: 123 Pacific Avenue, Mombasa, Kenya</p>
            <p><i class="fas fa-phone"></i> Phone: +254 712 345 678</p>
            <p><i class="fas fa-envelope"></i> Email: support@pacificcoach.co.ke</p>
            <p><i class="fas fa-clock"></i> Operating Hours: Monday - Sunday, 6:00 AM - 10:00 PM</p>

            <div class="social-icons">
                <h3>Follow Us</h3>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="contact-form-section">
            <h3>Send Us a Message</h3>
            <form action="process_contact.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <div class="map-section">
            <h3>Find Us on the Map</h3>
            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15917.472851410416!2d39.664468249999995!3d-4.04353455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x184000b021d15b13%3A0x6b4f74d008d511e!2sMombasa%2C%20Kenya!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>

</body>
</html>