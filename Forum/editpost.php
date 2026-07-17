<?php
include 'includes/DatabaseConnection.php';

if (isset($_POST['post_id'])) {
    $sql = 'UPDATE posts SET
        title = :title,
        content = :content,
        image_path = :image_path,
        user_id = :user_id,
        module_id = :module_id
        WHERE post_id = :post_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $_POST['title']);
    $stmt->bindValue(':content', $_POST['content']);
    $stmt->bindValue(':image_path', $_POST['image_path']);
    $stmt->bindValue(':user_id', $_POST['user_id']);
    $stmt->bindValue(':module_id', $_POST['module_id']);
    $stmt->bindValue(':post_id', $_POST['post_id']);
    $stmt->execute();

    header('location: posts.php');
    exit();
}
else {
    $post_id = $_GET['id'];

    $sql = 'SELECT * FROM posts WHERE post_id = :post_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $post_id);
    $stmt->execute();
    $post = $stmt->fetch();

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

    $title = 'Edit post';

    ob_start();
    include 'templates/editpost.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';