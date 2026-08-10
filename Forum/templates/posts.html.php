<h2>Post List</h2>

<?php
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin    = $isLoggedIn && $_SESSION['role'] === 'admin';
$isGuest    = !$isLoggedIn;
?>

<?php if (!$isGuest): ?>
    <p>
        <a href="addpost.php" class="button-link">Add New Post</a>
    </p>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
    <article>
        <h3><?=$post['title']?></h3>

        <p><?=$post['content']?></p>

        <p><strong>User:</strong> <?=$post['username']?></p>
        <p><strong>Module:</strong> <?=$post['module_name']?></p>

        <?php if (!empty($post['image_path'])): ?>
            <p>
                <img src="images/<?=$post['image_path']?>" alt="Post image">
            </p>
        <?php endif; ?>

        <?php
        $isOwner = $isLoggedIn && $_SESSION['user_id'] == $post['user_id'];
        ?>

        <?php if ($isAdmin || $isOwner): ?>
            <p>
                <a href="editpost.php?id=<?=$post['post_id']?>" class="edit-link">Edit</a>
            </p>

            <form action="deletepost.php" method="post" onsubmit="return confirmDelete('post');" class="small-form">
                <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                <input type="submit" value="Delete" class="delete-btn">
            </form>
        <?php endif; ?>
    </article>
<?php endforeach; ?>