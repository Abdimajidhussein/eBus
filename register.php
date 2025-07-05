<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacific Coach - Register</title>
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

        .register-container {
            flex-grow: 1; /* Allows the container to take up available space */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            margin: 100px;
        }

        .register-box {
            background: var(--white);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 30px var(--shadow);
            width: 100%;
            max-width: 450px; /* Slightly wider for more inputs */
            text-align: center;
        }

        .register-box h2 {
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
        .input-group input[type="email"],
        .input-group input[type="password"] {
            width: calc(100% - 20px); /* Account for padding */
            padding: 12px 10px;
            border: 1px solid var(--mid-gray);
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .input-group input[type="text"]:focus,
        .input-group input[type="email"]:focus,
        .input-group input[type="password"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn-register {
            background-color: var(--accent-color);
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

        .btn-register:hover {
            background-color: var(--accent-dark);
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

        .error-message, .success-message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.9em;
            text-align: left;
        }

        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .register-box {
                padding: 30px 20px;
            }
            .register-box h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Create Your Pacific Coach Account</h2>
            <?php
            // PHP logic for messages (example)
            if (isset($_GET['error'])) {
                $error_message = '';
                switch ($_GET['error']) {
                    case 'empty_fields':
                        $error_message = 'All fields are required.';
                        break;
                    case 'invalid_email':
                        $error_message = 'Please enter a valid email address.';
                        break;
                    case 'password_mismatch':
                        $error_message = 'Passwords do not match.';
                        break;
                    case 'username_taken':
                        $error_message = 'This username is already taken. Please choose another.';
                        break;
                    case 'email_taken':
                        $error_message = 'This email address is already registered.';
                        break;
                    case 'password_too_short':
                        $error_message = 'Password must be at least 8 characters long.';
                        break;
                    case 'password_too_long':
                        $error_message = 'Password cannot exceed 12 characters.'; // Specific for your requirement
                        break;
                    default:
                        $error_message = 'An unknown error occurred during registration.';
                        break;
                }
                echo '<p class="error-message">' . htmlspecialchars($error_message) . '</p>';
            } elseif (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<p class="success-message">Registration successful! You can now <a href="login.php">login</a>.</p>';
            }
            ?>
            <form action="includes/register_process.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="8" maxlength="12">
                    <small>Password must be between 8 and 12 characters.</small>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="8" maxlength="12">
                </div>
                <button type="submit" class="btn-register">Register Account</button>
            </form>
            <div class="links-container">
                <p>Already have an account? <a href="login.php">Login Here</a></p>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>