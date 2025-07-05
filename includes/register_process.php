<?php
// includes/register_process.php

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require_once 'config.php'; // Go up one directory from 'includes/'

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Sanitize and retrieve input data
    // Using htmlspecialchars to prevent XSS attacks when displaying values (though typically not displayed after processing)
    // Using trim to remove leading/trailing whitespace
    $username = trim(htmlspecialchars($_POST['username'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? ''; // Passwords are not sanitized with htmlspecialchars before hashing
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Initialize an array to store errors
    $errors = [];

    // 2. Server-side Validation

    // Check for empty fields
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'empty_fields';
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'invalid_email';
    }

    // Check password length (min 8, max 12 as per your requirement)
    if (strlen($password) < 8) {
        $errors[] = 'password_too_short';
    }
    if (strlen($password) > 12) {
        $errors[] = 'password_too_long';
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = 'password_mismatch';
    }

    // If no initial errors, proceed with database checks
    if (empty($errors)) {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'username_taken';
        }
        $stmt->close();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'email_taken';
        }
        $stmt->close();
    }

    // 3. Process based on validation results
    if (!empty($errors)) {
        // Redirect back to registration page with error messages
        $error_param = implode('&error=', $errors); // Combine multiple errors if needed
        header("Location: ../register.php?error=" . urlencode($errors[0])); // Redirect with the first error
        exit();
    } else {
        // All validation passed, proceed with registration

        // Hash the password securely
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL INSERT statement
        // Note: You can add first_name, last_name, phone_number if you add them to the form
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, user_type) VALUES (?, ?, ?, 'customer')");
        // 's' for string (username), 's' for string (email), 's' for string (password_hash)
        $stmt->bind_param("sss", $username, $email, $password_hash);

        if ($stmt->execute()) {
            // Registration successful
            // You might want to automatically log the user in or redirect to login page
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $conn->insert_id; // Get the ID of the newly inserted user
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = 'customer'; // Set default user type

            // Redirect to a success page or dashboard
            header("Location: ../index.php"); // Or dashboard.php
            exit();
        } else {
            // Database insertion failed
            header("Location: ../register.php?error=db_error");
            exit();
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();

} else {
    // If accessed directly without POST data, redirect to the registration form
    header("Location: ../register.php");
    exit();
}
?>