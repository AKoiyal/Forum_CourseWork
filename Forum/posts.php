<?php
include 'includes/DatabaseConnection.php';

$title = 'Post list';

$sql = 'SELECT posts.post_id, posts.title, posts.content, posts.image_path,
               users.username, modules.module_name
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        JOIN modules ON posts.module_id = modules.module_id';

$result = $pdo->query($sql);

foreach ($result as $row) {
    $posts[] = [
        'post_id' => $row['post_id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'image_path' => $row['image_path'],
        'username' => $row['username'],
        'module_name' => $row['module_name']
    ];
}

ob_start();
include 'templates/posts.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';