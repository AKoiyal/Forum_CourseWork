<?php
try {
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM posts WHERE post_id = :post_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $_POST['post_id']);
    $stmt->execute();

    header('location: posts.php');
    exit();
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';