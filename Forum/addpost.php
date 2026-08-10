<?php
session_start();
include 'includes/DatabaseConnection.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['title'])) {
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $moduleId = (int)($_POST['module_id'] ?? 0);
    $userId  = $_SESSION['user_id'];

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

    
    $imagePath = null;
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
                $imagePath = $safeName;
            } else {
                $errors[] = 'Failed to move uploaded file.';
            }
        }
    }

    if (empty($errors)) {
        $sql = 'INSERT INTO posts SET
                    title = :title,
                    content = :content,
                    image_path = :image_path,
                    user_id = :user_id,
                    module_id = :module_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image_path', $imagePath);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':module_id', $moduleId);
        $stmt->execute();

        header('Location: posts.php');
        exit();
    }

    
    $titlePage = 'Add a new post';

    $modulesql = 'SELECT module_id, module_name FROM modules';
    $moduleresult = $pdo->query($modulesql);
    $modules = [];
    foreach ($moduleresult as $row) {
        $modules[] = [
            'module_id'   => $row['module_id'],
            'module_name' => $row['module_name']
        ];
    }

    ob_start();
    ?>
    <h2>Add a New Post</h2>

    <div class="message message-error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?=$error?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Post title</label>
        <input type="text" name="title" id="title" value="<?=htmlspecialchars($title)?>" required>

        <label for="content">Post content</label>
        <textarea name="content" id="content" required><?=htmlspecialchars($content)?></textarea>

        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image" accept="image/*">

        <label for="module_id">Module</label>
        <select name="module_id" id="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['module_id']?>" <?=($module['module_id'] == $moduleId) ? 'selected' : ''?>>
                    <?=$module['module_name']?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Add Post">
    </form>
    <?php
    $output = ob_get_clean();
    include 'templates/layout.html.php';
    exit();
}
else {
    $titlePage = 'Add a new post';

    $modulesql = 'SELECT module_id, module_name FROM modules';
    $moduleresult = $pdo->query($modulesql);
    $modules = [];
    foreach ($moduleresult as $row) {
        $modules[] = [
            'module_id'   => $row['module_id'],
            'module_name' => $row['module_name']
        ];
    }

    ob_start();
    include 'templates/addpost.html.php';
    $output = ob_get_clean();

    include 'templates/layout.html.php';
}