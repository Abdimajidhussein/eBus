<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacific Coach - Home</title> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            /* Add padding-top to body to prevent content from being hidden behind sticky navbar */
            padding-top: 135px; /* Adjust this value based on the combined height of your header and navbar */
        }

        /* HEADER */
        .header-container {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 15px 0;
            position: fixed; /* Make header sticky */
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000; /* Ensure it's above other content */
            box-shadow: 0 4px 10px var(--shadow); /* Add shadow for depth */
        }

        .header {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 800;
        }

        .header h1 .pacific {
            color: var(--white);
        }

        .header h1 .coach {
            color: var(--accent-color);
            margin-left: 5px;
        }

        .header-badge {
            background: var(--accent-color);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85em;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 111, 97, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(255, 111, 97, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 111, 97, 0); }
        }

        /* NAVBAR */
        .navbar-container {
            background: var(--primary-light);
            box-shadow: 0 4px 10px var(--shadow); /* Moved shadow here from header-container */
            position: fixed; /* Make navbar sticky */
            width: 100%;
            top: 75px; /* Position it right below the header (header height ~75px) */
            left: 0;
            z-index: 999; /* Ensure it's below the header but above content */
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .navbar a {
            color: var(--white);
            text-decoration: none;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 30px;
        }

        .navbar a:hover {
            background: linear-gradient(to right, var(--accent-color), var(--accent-light));
            color: var(--white);
            transform: translateY(-2px);
        }

        .navbar a i {
            margin-right: 8px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                padding-top: 200px; /* Adjust padding-top for smaller screens as header might take more height */
            }
            .header-container {
                position: static; /* Make header static on small screens if it stacks */
                padding: 10px 0;
            }
            .header {
                flex-direction: column;
                gap: 10px; /* Reduced gap */
                text-align: center;
            }
            .header h1 {
                font-size: 2em; /* Smaller font size for header title */
            }
            .header-badge {
                padding: 6px 12px;
                font-size: 0.8em;
            }

            .navbar-container {
                position: static; /* Make navbar static on small screens if header is static */
                top: auto; /* Reset top positioning */
                padding: 5px 0; /* Reduced padding */
            }
            .navbar {
                flex-direction: column; /* Stack navbar links vertically */
                align-items: center; /* Center items when stacked */
                padding: 10px 20px;
                gap: 8px;
            }
            .navbar a {
                width: calc(100% - 40px); /* Adjust width for full stretch with padding */
                text-align: center;
                padding: 10px 15px;
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 180px; /* Further adjust padding for very small screens */
            }
            .header h1 {
                font-size: 1.8em;
            }
            .header-badge {
                font-size: 0.75em;
            }
            .navbar a {
                font-size: 0.85em;
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>

<div class="header-container">
    <div class="header">
        <h1><span class="pacific">Pacific</span> <span class="coach">Coach</span></h1>
        <div class="header-badge">24/7 Customer Support</div>
    </div>
</div>

<div class="navbar-container">
    <div class="navbar">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="view_schedules.php"><i class="fas fa-calendar-alt"></i> View Schedules</a>
        <a href="my_bookings.php"><i class="fas fa-ticket-alt"></i> My Bookings</a>
        <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
        <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
        <a href="login.php"><i class="fas fa-user"></i> Login / Register</a>
    </div>
</div>
</body>
</html>