<?php
// edit-profile.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Keep these for now while we're debugging display issues

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'includes/config.php';

$user_id = $_SESSION['user_id'];
$user = null;
$message = '';

// --- Fetch current user data ---
$stmt = $conn->prepare("SELECT id, email, first_name, last_name, phone_number, profile_picture_url FROM Users WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        session_unset();
        session_destroy();
        header("Location: login.php?error=user_not_found");
        exit();
    }
    $stmt->close();
} else {
    error_log("Error preparing fetch user data statement: " . $conn->error);
    $_SESSION['error_message'] = "Could not load profile data for editing. Please try again later.";
    header("Location: my-profile.php");
    exit();
}

// --- Handle form submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_email = trim($_POST['email'] ?? '');
    $new_first_name = trim($_POST['first_name'] ?? '');
    $new_last_name = trim($_POST['last_name'] ?? '');
    $new_phone_number = trim($_POST['phone_number'] ?? '');

    $errors = [];
    if (empty($new_email) || !filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($new_first_name)) {
        $errors[] = "First Name is required.";
    }

    $new_profile_picture_url = $user['profile_picture_url'];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp_name = $_FILES['profile_picture']['tmp_name'];
        $file_size = $_FILES['profile_picture']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_ext, $allowed_ext)) {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG, GIF are allowed.";
        }
        if ($file_size > $max_size) {
            $errors[] = "File size exceeds 5MB limit.";
        }

        if (empty($errors)) {
            $unique_file_name = uniqid('profile_', true) . '.' . $file_ext;
            $upload_dir = 'uploads/profile_pictures/';
            $target_file = $upload_dir . $unique_file_name;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                $current_pic_path = $user['profile_picture_url'];
                if (!empty($current_pic_path) && strpos($current_pic_path, 'default.png') === false && file_exists($current_pic_path)) {
                    unlink($current_pic_path);
                }
                $new_profile_picture_url = $target_file;
            } else {
                $errors[] = "Error uploading profile picture.";
                error_log("Failed to move uploaded file from {$file_tmp_name} to {$target_file}");
            }
        }
    }

    if (empty($errors)) {
        $update_stmt = $conn->prepare("UPDATE Users SET email = ?, first_name = ?, last_name = ?, phone_number = ?, profile_picture_url = ? WHERE id = ?");
        if ($update_stmt) {
            $update_stmt->bind_param("sssssi", $new_email, $new_first_name, $new_last_name, $new_phone_number, $new_profile_picture_url, $user_id);

            if ($update_stmt->execute()) {
                $message = "Profile updated successfully!";
                $user['email'] = $new_email;
                $user['first_name'] = $new_first_name;
                $user['last_name'] = $new_last_name;
                $user['phone_number'] = $new_phone_number;
                $user['profile_picture_url'] = $new_profile_picture_url;
            } else {
                $message = "Error updating profile: " . $update_stmt->error;
                error_log("Profile update failed for user_id {$user_id}: " . $update_stmt->error);
            }
            $update_stmt->close();
        } else {
            $message = "Database error preparing update statement: " . $conn->error;
            error_log("Error preparing update profile statement: " . $conn->error);
        }
    } else {
        $message = "Please correct the following errors:<br>" . implode("<br>", $errors);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Pacific Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php include 'includes/header.php'; ?>

    <style>
        /* Your CSS styles here (no changes needed for the extra input field) */
        :root {
            --primary-color: #0F4C81;
            --primary-dark: #0A3763;
            --accent-color: #FF6F61;
            --text-color: #343a40;
            --light-gray: #f8f9fa;
            --mid-gray: #e9ecef;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, 0.1);
            --red-danger: #dc3545;
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
            max-width: 700px;
            margin: 150px auto 50px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
        }

        h2.section-title {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
            font-size: 2.2em;
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
            width: 70px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1em;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="file"] { /* Keep type="file" here as it's still used by the one input */
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: 1px solid var(--mid-gray);
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="tel"]:focus,
        .form-group input[type="file"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .profile-picture-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-picture-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            box-shadow: 0 2px 10px var(--shadow);
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .button-group button,
        .button-group a.button {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: 700;
            text-decoration: none;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group button:hover,
        .button-group a.button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .button-group a.button.cancel {
            background-color: var(--mid-gray);
            color: var(--text-color);
        }

        .button-group a.button.cancel:hover {
            background-color: #d3d9df;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: 600;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 120px;
            }
            h2.section-title {
                font-size: 2em;
            }
            .button-group button,
            .button-group a.button {
                display: block;
                width: calc(100% - 20px);
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="section-title">Edit My Profile</h2>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($user): ?>
            <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
                <div class="profile-picture-container">
                    <img src="<?php echo htmlspecialchars($user['profile_picture_url'] ?: 'uploads/profile_pictures/default.png'); ?>" alt="Profile Picture">
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="profile_picture">Change Profile Picture:</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <small style="display: block; margin-top: 5px; color: #666;">Max 5MB (JPG, PNG, GIF)</small>
                    </div>
                    </div>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>">
                </div>

                <div class="button-group">
                    <button type="submit">Save Changes</button>
                    <a href="my-profile.php" class="button cancel">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: var(--text-color);">
                Could not load profile data for editing.
            </p>
            <div class="button-group">
                <a href="my-profile.php" class="button">Back to Profile</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>
</html>