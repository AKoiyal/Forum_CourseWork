<h2>Edit Post</h2>

<form action="" method="post">
    <input type="hidden" name="post_id" value="<?=$post['post_id']?>">

    <label for="title">Post title</label>
    <input type="text" name="title" id="title" value="<?=$post['title']?>" required>

    <label for="content">Post content</label>
    <textarea name="content" id="content" required><?=$post['content']?></textarea>

    <label for="image_path">Image file name</label>
    <input type="text" name="image_path" id="image_path" value="<?=$post['image_path']?>">

    <label for="user_id">User</label>
    <select name="user_id" id="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?=$user['user_id']?>" <?php if ($user['user_id'] == $post['user_id']) echo 'selected'; ?>>
                <?=$user['username']?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="module_id">Module</label>
    <select name="module_id" id="module_id" required>
        <?php foreach ($modules as $module): ?>
            <option value="<?=$module['module_id']?>" <?php if ($module['module_id'] == $post['module_id']) echo 'selected'; ?>>
                <?=$module['module_name']?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Update Post">
</form>