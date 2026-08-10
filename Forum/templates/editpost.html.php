<h2>Edit Post</h2>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?=$post['post_id']?>">

    <label for="title">Post title</label>
    <input type="text" name="title" id="title" value="<?=htmlspecialchars($post['title'])?>" required>

    <label for="content">Post content</label>
    <textarea name="content" id="content" required><?=htmlspecialchars($post['content'])?></textarea>

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
            <option value="<?=$module['module_id']?>" <?=($module['module_id'] == $post['module_id']) ? 'selected' : ''?>>
                <?=$module['module_name']?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Update Post">
</form>