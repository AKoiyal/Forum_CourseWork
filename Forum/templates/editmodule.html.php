<h2>Edit Module</h2>

<form action="" method="post">
    <input type="hidden" name="module_id" value="<?=$module['module_id']?>">

    <label for="module_code">Module code</label>
    <input type="text" name="module_code" id="module_code"
           value="<?=$module['module_code']?>" required>

    <label for="module_name">Module name</label>
    <input type="text" name="module_name" id="module_name"
           value="<?=$module['module_name']?>" required>

    <input type="submit" value="Update Module">
</form>