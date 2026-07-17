<?php
include 'includes/DatabaseConnection.php';

$title = 'User List';

$sql = 'SELECT user_id, username, email FROM users';
$result = $pdo->query($sql);

$users = [];

foreach ($result as $row) {
    $users[] = [
        'user_id' => $row['user_id'],
        'username' => $row['username'],
        'email' => $row['email']
    ];
}

ob_start();
include 'templates/users.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';