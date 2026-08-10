<?php
session_start();
include 'includes/DatabaseConnection.php';


$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin    = $isLoggedIn && $_SESSION['role'] === 'admin';

$title = 'User List';


$sql = 'SELECT user_id, username, email, role FROM users ORDER BY user_id ASC';
$result = $pdo->query($sql);

$users = [];
foreach ($result as $row) {
    $users[] = [
        'user_id' => $row['user_id'],
        'username' => $row['username'],
        'email' => $row['email'],
        'role' => $row['role'],
    ];
}

ob_start();
include 'templates/users.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';