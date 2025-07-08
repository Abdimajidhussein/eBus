<?php
// contact.php

// Include your database configuration
require_once 'includes/config.php';

// Initialize variables for feedback messages
$status_message = '';
$message_type = ''; // 'success' or 'error'

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve and sanitize form data
    // trim() removes whitespace from the beginning and end of a string
    $fullName = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // 2. Basic validation
    $errors = [];

    if (empty($fullName)) {
        $errors[] = "Your name is required.";
    }
    if (empty($email)) {
        $errors[] = "Your email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }
    if (empty($message)) {
        $errors[] = "Your message is required.";
    }

    if (empty($errors)) {
        // Use Prepared Statements for secure insertion
        $stmt = $conn->prepare("INSERT INTO ContactUsMessages (FullName, EmailAddress, Subject, Message) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            // 'ssss' indicates four string parameters
            $stmt->bind_param("ssss", $fullName, $email, $subject, $message);

            if ($stmt->execute()) {
                $status_message = "Your message has been sent successfully!";
                $message_type = "success";
                // Clear form fields after successful submission
                $fullName = $email = $subject = $message = '';
            } else {
                $status_message = "There was an error sending your message. Please try again later.";
                $message_type = "error";
                // Log the actual database error for debugging (never show to users)
                error_log("Error executing contact form statement: " . $stmt->error);
            }
            $stmt->close();
        } else {
            $status_message = "An internal error occurred. Please try again.";
            $message_type = "error";
            error_log("Error preparing contact form statement: " . $conn->error);
        }
    } else {
        // Validation errors occurred
        $status_message = implode("<br>", $errors);
        $message_type = "error";
    }

    // Close database connection after all operations
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pacific Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php include 'includes/header.php'; // Assuming your header includes navigation, etc. ?>

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
            margin: 150px auto; /* Adjust margin-top to clear fixed header if any */
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

        /* Message Alert Styles */
        .message-alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            width: 100%; /* Span full width of container */
            box-sizing: border-box; /* Include padding in width */
        }
        .message-alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message-alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
        <?php
        // Display feedback message if any
        if (!empty($status_message)) {
            echo '<div class="message-alert ' . $message_type . '">' . $status_message . '</div>';
        }
        ?>
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
            <form action="contact.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fullName ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <div class="map-section">
            <h3>Find Us on the Map</h3>
            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15959.882190977274!2d39.664408900000005!3d-4.04856015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18401344485eb03b%3A0x67df3c921316b252!2sMombasa%20County!5e0!3m2!1sen!2ske!4v1700000000000!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; // Assuming your footer includes closing body/html tags ?>

</body>
</html>