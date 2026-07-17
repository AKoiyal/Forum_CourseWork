<?php
include 'includes/DatabaseConnection.php';

if (isset($_POST['user_id'])) {
    $sql = 'UPDATE users SET
        username = :username,
        email = :email
        WHERE user_id = :user_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $_POST['username']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':user_id', $_POST['user_id']);
    $stmt->execute();

    header('location: users.php');
    exit();
}
else {
    if (!isset($_GET['id'])) {
        $title = 'Error';
        $output = 'No user ID was provided.';
    }
    else {
        $sql = 'SELECT user_id, username, email
                FROM users
                WHERE user_id = :user_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $_GET['id']);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!$user) {
            $title = 'Error';
            $output = 'User not found.';
        }
        else {
            $title = 'Edit User';

            ob_start();
            include 'templates/edituser.html.php';
            $output = ob_get_clean();
        }
    }
}

include 'templates/layout.html.php';