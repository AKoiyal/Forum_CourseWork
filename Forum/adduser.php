<?php
if (isset($_POST['username'])) {
    try {
        include 'includes/DatabaseConnection.php';

        $sql = 'INSERT INTO users (username, email)
                VALUES (:username, :email)';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $_POST['username']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();

        header('location: users.php');
        exit();
    }
    catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
else {
    $title = 'Add user';

    ob_start();
    include 'templates/adduser.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';