<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $_SESSION['username'] ?? '';
$isAdmin = ($_SESSION['user_type'] ?? '') === 'admin';

$base_path = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pacific Coach - Navigation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --primary-color: #0F4C81;
            --primary-light: #1a5d9a;
            --primary-dark: #0A3763;
            --accent-color: #FF6F61;
            --white: #fff;
            --shadow: rgba(0, 0, 0, 0.1);
            --navbar-bg: #0A3D62;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-top: 135px;
            background-color: var(--light-gray);
            color: #343a40;
        }

        .header-container {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px var(--shadow);
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
            font-size: 2.3em;
        }

        .pacific {
            color: var(--white);
        }

        .coach {
            color: var(--accent-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-badge {
            background: var(--accent-color);
            color: white;
            padding: 7px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            color: var(--white);
            padding: 8px 15px;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            background: var(--primary-dark);
        }

        .dropdown-toggle i {
            margin-right: 8px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--primary-light);
            min-width: 180px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1001;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 0.85em;
        }

        .dropdown-content a:hover {
            background-color: var(--accent-color);
        }

        /* Navbar */
        .navbar-container {
            position: fixed;
            top: 75px;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); /* Updated */
            box-shadow: 0 4px 10px var(--shadow);
            z-index: 999;
        }

        .navbar {
            max-width: 1200px;
            margin: auto;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 30px;
            transition: 0.3s;
            font-size: 0.95em;
        }

        .navbar a:hover {
            background: linear-gradient(to right, var(--accent-color), #ff8b81);
        }

        @media (max-width: 768px) {
            body {
                padding-top: 200px;
            }

            .header-container {
                position: static;
                box-shadow: none;
                padding-bottom: 0;
            }

            .navbar-container {
                position: static;
                top: auto;
                box-shadow: none;
                padding-top: 0;
            }

            .header {
                flex-direction: column;
                text-align: center;
                padding-bottom: 10px;
            }

            .header-right {
                margin-top: 10px;
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }

            .header-badge, .dropdown-toggle {
                width: calc(100% - 30px);
                text-align: center;
            }

            .navbar {
                flex-direction: column;
                align-items: center;
                padding-top: 10px;
            }

            .navbar a {
                width: calc(100% - 40px);
                text-align: center;
            }

            .dropdown-content {
                position: static;
                width: 100%;
                box-shadow: none;
                border-radius: 0;
            }

            .dropdown-content a {
                text-align: center;
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
                <div class="dropdown-toggle"><i class="fas fa-user-circle"></i> Hi, <?= htmlspecialchars($username) ?></div>
                <div class="dropdown-content">
                    <a href="profile.php"><i class="fas fa-id-badge"></i> My Profile</a>
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
