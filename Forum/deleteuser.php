<?php
try {
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM users WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $_POST['user_id']);
    $stmt->execute();

    header('location: users.php');
    exit();
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();

    include 'templates/layout.html.php';
}