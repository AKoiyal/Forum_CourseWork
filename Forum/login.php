<?php
session_start();
include 'includes/DatabaseConnection.php';

$title = 'Login';

$error_student = '';
$error_admin = '';

// Login student (email + plain password)
if (isset($_POST['student_email']) && isset($_POST['student_password'])) {
    $sql = 'SELECT user_id, username, email, password, role
            FROM users
            WHERE email = :email';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $_POST['student_email']);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user && $user['role'] === 'student' && $_POST['student_password'] === $user['password']) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role']; // 'student'

        header('location: index.php');
        exit();
    } else {
        $error_student = 'Incorrect student email or password.';
    }
}

// Login admin (popup Admin Area, chỉ password)
if (isset($_POST['admin_password'])) {
    $sql = 'SELECT user_id, username, email, password, role
            FROM users
            WHERE role = "admin"
            LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $admin = $stmt->fetch();

    if ($admin && $_POST['admin_password'] === $admin['password']) {
        $_SESSION['user_id'] = $admin['user_id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['email'] = $admin['email'];
        $_SESSION['role'] = $admin['role']; // 'admin'

            header('location: index.php');
        exit();
    } else {
        $error_admin = 'Incorrect admin password.';
    }
}

ob_start();
include 'templates/login.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';