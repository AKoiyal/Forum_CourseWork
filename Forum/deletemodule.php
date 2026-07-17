<?php
try {
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM modules WHERE module_id = :module_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':module_id', $_POST['module_id']);
    $stmt->execute();

    header('location: modules.php');
    exit();
}
catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();

    include 'templates/layout.html.php';
}