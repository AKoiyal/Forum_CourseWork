<?php
require_once __DIR__ . '/../config/db.php';

$sql = "SELECT p.post_id, p.title, p.content, p.image_path, p.created_at,
               u.username,
               m.module_code, m.module_name
        FROM posts p
        INNER JOIN users u ON p.user_id = u.user_id
        INNER JOIN modules m ON p.module_id = m.module_id
        ORDER BY p.created_at DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/index.html.php';