<?php
include 'includes/DatabaseConnection.php';

if (isset($_POST['title'])) {
    $sql = 'INSERT INTO posts SET
        title = :title,
        content = :content,
        image_path = :image_path,
        user_id = :user_id,
        module_id = :module_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $_POST['title']);
    $stmt->bindValue(':content', $_POST['content']);
    $stmt->bindValue(':image_path', $_POST['image_path']);
    $stmt->bindValue(':user_id', $_POST['user_id']);
    $stmt->bindValue(':module_id', $_POST['module_id']);
    $stmt->execute();

    header('location: posts.php');
    exit();
}
else {
    $title = 'Add a new post';

    $usersql = 'SELECT user_id, username FROM users';
    $userresult = $pdo->query($usersql);

    foreach ($userresult as $row) {
        $users[] = [
            'user_id' => $row['user_id'],
            'username' => $row['username']
        ];
    }

    $modulesql = 'SELECT module_id, module_name FROM modules';
    $moduleresult = $pdo->query($modulesql);

    foreach ($moduleresult as $row) {
        $modules[] = [
            'module_id' => $row['module_id'],
            'module_name' => $row['module_name']
        ];
    }

    ob_start();
    include 'templates/addpost.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';