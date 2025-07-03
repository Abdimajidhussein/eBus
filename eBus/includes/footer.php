<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    padding: 50px 20px 20px;
}

.footer-container {
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.footer h3 {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.footer p, .footer a {
    color: #ddd;
    font-size: 0.95em;
    line-height: 1.6;
}

.footer a:hover {
    color: var(--white);
}

.social-icons {
    margin-top: 15px;
}

.social-icons a {
    color: #ddd;
    margin-right: 15px;
    font-size: 20px;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: var(--accent-color);
}

.footer-bottom {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid var(--primary-dark);
    font-size: 0.9em;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    /* No specific footer adjustments provided in original CSS for 768px, 
       but the grid `auto-fit` will handle column wrapping. */
}

@media (max-width: 480px) {
    /* No specific footer adjustments provided in original CSS for 480px, 
       but the grid `auto-fit` will handle column wrapping. */
}
</style>
</body>
</html>