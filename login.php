<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacific Coach - Login</title>
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
            padding-top: 80px; /* Adjust based on your header's actual height */
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures footer stays at the bottom */
        }

        .login-container {
            flex-grow: 1; /* Allows the container to take up available space */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            margin: 100px;
        }

        .login-box {
            background: var(--white);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 30px var(--shadow);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h2 {
            font-size: 2em;
            color: var(--primary-dark);
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
        }

        .input-group input[type="text"],
        .input-group input[type="password"] {
            width: calc(100% - 20px); /* Account for padding */
            padding: 12px 10px;
            border: 1px solid var(--mid-gray);
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .input-group input[type="text"]:focus,
        .input-group input[type="password"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn-login {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1.1em;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .links-container {
            margin-top: 20px;
            font-size: 0.9em;
        }

        .links-container a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links-container a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .error-message {
            color: var(--accent-color);
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-box {
                padding: 30px 20px;
            }
            .login-box h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login to Pacific Coach</h2>
            <?php
            // PHP logic for error messages (example)
            if (isset($_GET['error'])) {
                echo '<p class="error-message">Invalid username or password.</p>';
            }
            ?>
            <form action="includes/login_process.php" method="POST">
                <div class="input-group">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required maxlength="32">
    </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
            <div class="links-container">
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                <p><a href="#">Forgot Password?</a></p>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>