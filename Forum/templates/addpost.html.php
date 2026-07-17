<h2>Add a New Post</h2>

<form action="" method="post">
    <label for="title">Post title</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Post content</label>
    <textarea name="content" id="content" required></textarea>

    <label for="image_path">Image file name</label>
    <input type="text" name="image_path" id="image_path" placeholder="example: chicken.png">

    <label for="user_id">User</label>
    <select name="user_id" id="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?=$user['user_id']?>"><?=$user['username']?></option>
        <?php endforeach; ?>
    </select>

    <label for="module_id">Module</label>
    <select name="module_id" id="module_id" required>
        <?php foreach ($modules as $module): ?>
            <option value="<?=$module['module_id']?>"><?=$module['module_name']?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Add Post">
</form>