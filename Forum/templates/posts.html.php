<h2>Post List</h2>

<p>
    <a href="addpost.php" class="button-link">Add New Post</a>
</p>

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

        <p>
            <a href="editpost.php?id=<?=$post['post_id']?>" class="edit-link">Edit</a>
        </p>

        <form action="deletepost.php" method="post" onsubmit="return confirmDelete('post');" class="small-form">
            <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
            <input type="submit" value="Delete" class="delete-btn">
        </form>
    </article>
<?php endforeach; ?>