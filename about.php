<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Pacific Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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
            margin: 150px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
        }

        h2.section-title {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px; /* Add space for the pseudo-element */
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

        .about-section {
            margin-bottom: 30px;
        }

        .about-section h3 {
            color: var(--primary-color);
            font-size: 1.8em;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .about-section p {
            font-size: 1.05em;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            background-color: var(--light-gray);
            padding: 10px 15px;
            margin-bottom: 8px;
            border-left: 5px solid var(--accent-color);
            border-radius: 4px;
            display: flex;
            align-items: center;
            font-size: 1em;
            color: var(--text-color);
        }

        ul li:last-child {
            margin-bottom: 0;
        }

        ul li i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 1.2em;
        }

        .cta-button {
            display: block;
            width: fit-content;
            margin: 40px auto 0;
            background-color: var(--accent-color);
            color: var(--white);
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
            font-size: 1.1em;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cta-button:hover {
            background-color: #e05e54;
            transform: translateY(-3px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
                padding: 20px;
            }
            h2.section-title {
                font-size: 2em;
            }
            .about-section h3 {
                font-size: 1.5em;
            }
            .about-section p {
                font-size: 0.95em;
            }
            ul li {
                padding: 8px 12px;
                font-size: 0.95em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="section-title">About Pacific Coach</h2>

        <div class="about-section">
            <h3>Our Story</h3>
            <p>
                Founded with a vision to revolutionize bus travel in Kenya, **Pacific Coach** has grown from humble beginnings to become a trusted name in passenger and parcel transport. Our journey began in Mombasa, and since then, we've been dedicated to connecting communities across Kenya with safe, reliable, and comfortable travel solutions. We believe in providing more than just a ride; we offer an experience built on trust and convenience.
            </p>
        </div>

        <div class="about-section">
            <h3>Our Mission</h3>
            <p>
                To provide exceptional, affordable, and safe bus travel and parcel delivery services, fostering connections and contributing to the socio-economic growth of Kenya. We aim to exceed customer expectations through continuous improvement and a commitment to excellence.
            </p>
        </div>

        <div class="about-section">
            <h3>Why Choose Pacific Coach?</h3>
            <ul>
                <li><i class="fas fa-route"></i> **Extensive Network:** Connecting major towns and cities across Kenya.</li>
                <li><i class="fas fa-shield-alt"></i> **Safety First:** Prioritizing your safety with well-maintained buses and experienced drivers.</li>
                <li><i class="fas fa-chair"></i> **Comfortable Journey:** Modern fleet equipped for a relaxing travel experience.</li>
                <li><i class="fas fa-hand-holding-usd"></i> **Affordable Fares:** Quality service that offers great value for your money.</li>
                <li><i class="fas fa-box-open"></i> **Reliable Parcel Services:** Delivering your packages promptly and securely.</li>
                <li><i class="fas fa-clock"></i> **Punctuality:** We respect your time and strive for on-time departures and arrivals.</li>
                <li><i class="fas fa-headset"></i> **Dedicated Customer Support:** Available 24/7 to assist you.</li>
            </ul>
        </div>

        <div class="about-section">
            <h3>Our Values</h3>
            <p>
                At Pacific Coach, our operations are guided by a core set of values:
            </p>
            <ul>
                <li>**Integrity:** Upholding honesty and ethical standards in all our dealings.</li>
                <li>**Customer Focus:** Placing our customers at the heart of everything we do.</li>
                <li>**Excellence:** Striving for the highest standards in service delivery.</li>
                <li>**Teamwork:** Collaborating effectively to achieve shared goals.</li>
                <li>**Innovation:** Continuously seeking new ways to enhance our services.</li>
            </ul>
        </div>

        <a href="contact.php" class="cta-button">Have a Question? Contact Us!</a>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php include 'includes/footer.php'; ?>

</body>
</html>