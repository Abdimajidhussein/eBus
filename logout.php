<?php
// Start the session if it's not already started
// This is crucial to access and destroy session variables.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Unset all session variables.
// This removes all data stored in the current session.
$_SESSION = array();

// 2. Destroy the session cookie.
// This makes sure the session ID is no longer valid.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destroy the session itself.
// This removes the session file from the server.
session_destroy();

// 4. Redirect the user to a public page (e.g., login page or homepage).
// It's good practice to redirect immediately after session destruction.
header("Location: login.php"); // Or index.php, depending on your preference
exit; // Always call exit after a header redirect to prevent further script execution
?>