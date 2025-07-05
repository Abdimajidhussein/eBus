<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';
    $errors = [];

    if (empty($username_or_email) || empty($password)) {
        $errors[] = 'empty_fields';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, username, password_hash, user_type, is_active FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (!$user['is_active']) {
                $errors[] = 'account_inactive';
            } elseif (password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];

                $update_stmt = $conn->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();
                $update_stmt->close();

                header("Location: ../index.php");
                exit();
            } else {
                $errors[] = 'invalid_credentials';
            }
        } else {
            $errors[] = 'invalid_credentials';
        }

        $stmt->close();
    }

    if (!empty($errors)) {
        header("Location: ../login.php?error=" . urlencode($errors[0]));
        exit();
    }

    $conn->close();
} else {
    header("Location: ../login.php");
    exit();
}
?>
