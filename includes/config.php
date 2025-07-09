<?php
// includes/config.php - Database Connection Configuration

// --- DATABASE CREDENTIALS ---
// YOU MUST UPDATE THESE WITH YOUR ACTUAL DATABASE DETAILS.
define('DB_HOST', 'localhost');          // Your database host (e.g., 'localhost' or an IP address)
define('DB_NAME', 'ebus'); // The name of your database
define('DB_USER', 'root');      // Your database username
define('DB_PASS', '');      // Your database password
define('DB_CHARSET', 'utf8mb4');         // Character set for the connection

// --- PDO DSN and Options ---
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation for better security and performance
];

// --- Establish Database Connection ---
$pdo = null; // Initialize $pdo to null

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
    // Log the error (for developer debugging, not shown to end-user)
    error_log("Database Connection Error: " . $e->getMessage());

    // Display a user-friendly message and stop script execution
    // In a production environment, it's crucial NOT to expose $e->getMessage() for security.
    die('<p style="text-align:center; color:red; font-weight:bold; margin-top: 50px;">A system error occurred. Please try again later.</p>');
    // For debugging during development, you could temporarily use:
    // die('<p style="text-align:center; color:red; font-weight:bold; margin-top: 50px;">Database Connection Error: ' . $e->getMessage() . '</p>');
}
?>