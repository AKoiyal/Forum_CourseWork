<?php
session_start();
include 'includes/DatabaseConnection.php';

// Đảm bảo đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['post_id'])) {
    $postId  = (int)($_POST['post_id'] ?? 0);
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $moduleId = (int)($_POST['module_id'] ?? 0);

    // Lấy thông tin post hiện tại
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    $stmt->bindValue(':post_id', $postId);
    $stmt->execute();
    $post = $stmt->fetch();

    if (!$post) {
        // Post không tồn tại
        header('Location: posts.php');
        exit();
    }

    // Kiểm tra quyền: chỉ owner hoặc admin mới được edit
    $isAdmin  = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $isOwner  = $_SESSION['user_id'] == $post['user_id'];

    if (!$isAdmin && !$isOwner) {
        header('Location: posts.php');
        exit();
    }

    $errors = [];

    if ($title === '') {
        $errors[] = 'Title is required.';
    }
    if ($content === '') {
        $errors[] = 'Content is required.';
    }
    if ($moduleId <= 0) {
        $errors[] = 'Please select a valid module.';
    }

    // Xử lý upload ảnh mới (nếu có)
    $imagePath = $post['image_path']; // mặc định giữ ảnh cũ
    if (!empty($_FILES['image']['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName    = $_FILES['image']['name'];
        $fileSize    = $_FILES['image']['size'];
        $fileType    = $_FILES['image']['type'];
        $fileError   = $_FILES['image']['error'];

        if ($fileError !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload error code: ' . $fileError;
        } elseif (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Only JPG, PNG, GIF, WEBP images are allowed.';
        } elseif ($fileSize > $maxSize) {
            $errors[] = 'File size must be under 2MB.';
        } else {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $baseName = pathinfo($fileName, PATHINFO_FILENAME);
            $safeName = preg_replace('/[^A-Za-z0-9_-]/', '_', $baseName) . '.' . $ext;

            $targetDir = __DIR__ . '/images/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetPath = $targetDir . $safeName;

            if (file_exists($targetPath)) {
                $safeName = time() . '_' . $safeName;
                $targetPath = $targetDir . $safeName;
            }

            if (move_uploaded_file($fileTmpPath, $targetPath)) {
                // Xóa ảnh cũ nếu có
                if (!empty($post['image_path'])) {
                    $oldPath = __DIR__ . '/images/' . $post['image_path'];
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $imagePath = $safeName;
            } else {
                $errors[] = 'Failed to move uploaded file.';
            }
        }
    }

    if (empty($errors)) {
        $sql = 'UPDATE posts SET
                    title = :title,
                    content = :content,
                    module_id = :module_id,
                    image_path = :image_path
                WHERE post_id = :post_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':module_id', $moduleId);
        $stmt->bindValue(':image_path', $imagePath);
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();

        header('Location: posts.php');
        exit();
    }

    // Nếu có lỗi, hiển thị lại form với thông báo
    $modulesql = 'SELECT module_id, module_name FROM modules';
    $moduleresult = $pdo->query($modulesql);
    $modules = [];
    foreach ($moduleresult as $row) {
        $modules[] = [
            'module_id'   => $row['module_id'],
            'module_name' => $row['module_name']
        ];
    }

    $titlePage = 'Edit post';

    ob_start();
    ?>
    <h2>Edit Post</h2>

    <div class="message message-error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?=$error?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?=$post['post_id']?>">

        <label for="title">Post title</label>
        <input type="text" name="title" id="title" value="<?=htmlspecialchars($title)?>" required>

        <label for="content">Post content</label>
        <textarea name="content" id="content" required><?=htmlspecialchars($content)?></textarea>

        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image" accept="image/*">

        <?php if (!empty($post['image_path'])): ?>
            <p>
                Current image: <img src="images/<?=$post['image_path']?>" alt="Current image" style="max-width:200px;">
            </p>
        <?php endif; ?>

        <label for="module_id">Module</label>
        <select name="module_id" id="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['module_id']?>" <?=($module['module_id'] == $moduleId) ? 'selected' : ''?>>
                    <?=$module['module_name']?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Update Post">
    </form>
    <?php
    $output = ob_get_clean();
    include 'templates/layout.html.php';
    exit();
}
else {
    // Hiển thị form edit (GET)
    $postId = $_GET['id'] ?? 0;

    $stmt = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    $stmt->bindValue(':post_id', $postId);
    $stmt->execute();
    $post = $stmt->fetch();

    if (!$post) {
        header('Location: posts.php');
        exit();
    }

    // Kiểm tra quyền: chỉ owner hoặc admin mới được edit
    $isAdmin  = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $isOwner  = $_SESSION['user_id'] == $post['user_id'];

    if (!$isAdmin && !$isOwner) {
        header('Location: posts.php');
        exit();
    }

    $modulesql = 'SELECT module_id, module_name FROM modules';
    $moduleresult = $pdo->query($modulesql);
    $modules = [];
    foreach ($moduleresult as $row) {
        $modules[] = [
            'module_id'   => $row['module_id'],
            'module_name' => $row['module_name']
        ];
    }

    $titlePage = 'Edit post';

    ob_start();
    include 'templates/editpost.html.php';
    $output = ob_get_clean();

    include 'templates/layout.html.php';
}