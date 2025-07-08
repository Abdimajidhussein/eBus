<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $_SESSION['username'] ?? '';
$isAdmin = ($_SESSION['user_type'] ?? '') === 'admin';

// Placeholder for user profile image path
// In a real application, this would come from the database
// For demonstration, let's assume a default image or a path from session
$profileImagePath = 'images/default_profile.png'; // Make sure you have this image or change the path
if ($isLoggedIn && isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
    $profileImagePath = htmlspecialchars($_SESSION['profile_image']);
}

$base_path = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pacific Coach - Navigation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <style>
        :root {
            /* Professional Palette: Dark Grey/Blue with Gold Accent */
            --header-bg-start: #2C3E50; /* Dark Charcoal */
            --header-bg-end: #1A2530; /* Even Darker Grey/Blue */
            --navbar-bg: #34495E; /* Slightly lighter dark grey for navbar */
            --accent-color: #F39C12; /* Golden Orange */
            --accent-light: #FFB347; /* Lighter Gold */
            --text-light: #ECF0F1; /* Off-white for text */
            --white: #fff;
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.3);
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-top: 135px; /* Adjust if header/navbar height changes */
            background-color: var(--light-gray);
            color: #343a40;
            line-height: 1.6;
        }

        /* Header Styles */
        .header-container {
            background: linear-gradient(135deg, var(--header-bg-start), var(--header-bg-end));
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px var(--shadow-dark);
        }

        .header {
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em; /* Slightly larger for presence */
            font-weight: 700;
        }

        .pacific {
            color: var(--text-light); /* Off-white */
        }

        .coach {
            color: var(--accent-color); /* Golden Orange accent */
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px; /* Increased gap */
        }

        .header-badge {
            background: var(--accent-color); /* Golden Orange */
            color: var(--white);
            padding: 8px 18px; /* Slightly larger padding */
            border-radius: 25px; /* More rounded */
            font-size: 0.9em;
            font-weight: 600;
            box-shadow: 0 2px 5px var(--shadow-light);
            transition: background 0.3s ease;
        }
        .header-badge:hover {
            background: var(--accent-light);
        }

        /* Dropdown & Profile Picture */
        .dropdown {
            position: relative;
        }

        .profile-dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 5px 10px; /* Padding around image and text */
            border-radius: 30px; /* Rounded pill shape */
            background-color: rgba(255, 255, 255, 0.1); /* Subtle background */
            transition: background-color 0.3s ease;
        }
        .profile-dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .profile-image {
            width: 40px; /* Size of profile picture */
            height: 40px;
            border-radius: 50%; /* Make it circular */
            object-fit: cover;
            border: 2px solid var(--accent-color); /* Accent border */
            margin-right: 10px;
            box-shadow: 0 0 8px rgba(243, 156, 18, 0.5); /* Glowing effect */
        }

        .profile-username {
            color: var(--text-light);
            font-weight: 500;
            font-size: 1em;
            margin-right: 8px; /* Space before caret */
        }

        .profile-dropdown-toggle i {
            color: var(--text-light);
        }


        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--navbar-bg); /* Use navbar background for dropdown */
            min-width: 200px; /* Wider dropdown */
            box-shadow: 0 8px 20px var(--shadow-dark);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1001;
            transform: translateY(10px); /* Slight animation for dropdown */
            opacity: 0;
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }

        .dropdown-content a {
            color: var(--text-light);
            padding: 12px 18px;
            text-decoration: none;
            display: flex; /* Use flex for icon and text alignment */
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.08); /* Subtler divider */
            font-size: 0.9em;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .dropdown-content a:last-child {
            border-bottom: none; /* No border on last item */
        }

        .dropdown-content a i {
            margin-right: 10px;
            color: var(--accent-light); /* Accent color for icons */
        }

        .dropdown-content a:hover {
            background-color: var(--header-bg-start); /* Darker background on hover */
            color: var(--accent-color); /* Text color changes to accent on hover */
        }

        /* Navbar */
        .navbar-container {
            position: fixed;
            top: 75px; /* Directly below the header */
            left: 0;
            width: 100%;
            background-color: var(--navbar-bg); /* Solid dark grey for navbar */
            box-shadow: 0 4px 15px var(--shadow-dark);
            z-index: 999;
        }

        .navbar {
            max-width: 1200px;
            margin: auto;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end; /* Align items to the right */
            gap: 15px; /* Increased gap between nav items */
            flex-wrap: wrap;
        }

        .navbar a {
            color: var(--text-light);
            text-decoration: none;
            padding: 10px 22px; /* Slightly more padding */
            font-weight: 500; /* Medium weight for professionalism */
            border-radius: 30px;
            transition: all 0.3s ease;
            font-size: 0.95em;
        }

        .navbar a:hover, .navbar a.active { /* Added .active class for current page */
            background-color: var(--accent-color); /* Golden orange on hover/active */
            color: var(--white);
            transform: translateY(-2px); /* Subtle lift effect */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar a i {
            margin-right: 8px; /* Space for icons */
        }


        /* Responsive Adjustments */
        @media (max-width: 768px) {
            body {
                padding-top: 200px; /* Adjust padding for stacked header/navbar */
            }

            .header-container {
                position: static; /* Header becomes part of the flow */
                box-shadow: none;
                padding-bottom: 0;
            }

            .navbar-container {
                position: static; /* Navbar becomes part of the flow */
                top: auto;
                box-shadow: none;
                padding-top: 0;
            }

            .header {
                flex-direction: column;
                text-align: center;
                padding-bottom: 10px;
            }

            .header h1 {
                font-size: 2em; /* Smaller on mobile */
            }

            .header-right {
                margin-top: 15px; /* More space */
                flex-direction: column;
                width: 100%;
                gap: 15px;
            }

            .header-badge, .profile-dropdown-toggle {
                width: calc(100% - 40px); /* Account for padding */
                text-align: center;
                justify-content: center; /* Center content in badge/dropdown toggle */
                padding: 10px 20px; /* More padding for touch */
            }
            .profile-dropdown-toggle .profile-username {
                flex-grow: 1; /* Allow username to take space */
                text-align: center;
            }
            .profile-dropdown-toggle i.fa-caret-down {
                margin-left: auto; /* Push caret to the right */
            }


            .navbar {
                flex-direction: column;
                align-items: center;
                padding-top: 15px; /* More padding */
            }

            .navbar a {
                width: calc(100% - 40px);
                text-align: center;
                padding: 12px 20px; /* Larger touch targets */
            }

            .dropdown-content {
                position: static; /* Dropdown expands inline */
                width: 100%;
                box-shadow: none;
                border-radius: 0;
                transform: none; /* Remove transform on mobile */
                opacity: 1; /* Always visible when parent is hovered/tapped */
            }

            .dropdown-content a {
                text-align: left; /* Keep text left-aligned in mobile dropdown */
                justify-content: flex-start; /* Align icons to the left */
                padding-left: 30px; /* Indent mobile dropdown items */
            }
        }
    </style>
</head>
<body>

<div class="header-container">
    <div class="header">
        <h1><span class="pacific">Pacific</span> <span class="coach">Coach</span></h1>
        <div class="header-right">
            <div class="header-badge">24/7 Support</div>

            <?php if ($isLoggedIn): ?>
            <div class="dropdown">
                <div class="profile-dropdown-toggle">
                    <img src="<?= $profileImagePath ?>" alt="Profile Picture" class="profile-image">
                    <span class="profile-username">Hi, <?= htmlspecialchars($username) ?></span>
                    <i class="fas fa-caret-down"></i>
                </div>
                
                <div class="dropdown-content">
                    <a  href="profile.php"><i class="fas fa-id-badge"></i> My Profile</a>
                    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                    <a href="change_password.php"><i class="fas fa-key"></i> Change Password</a>
                    <?php if ($isAdmin): ?>
                        <a href="admin/dashboard.php"><i class="fas fa-cogs"></i> Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="navbar-container">
    <div class="navbar">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="view_schedules.php"><i class="fas fa-calendar-alt"></i> View Schedules</a>
        <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
        <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>

        <?php if ($isLoggedIn): ?>
            <a href="my_bookings.php"><i class="fas fa-ticket-alt"></i> My Bookings</a>
        <?php else: ?>
            <a href="login.php"><i class="fas fa-user"></i> Login / Register</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>