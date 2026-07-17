<h2>Module List</h2>

<p>
    <a href="addmodule.php" class="button-link">Add New Module</a>
</p>

<table>
    <tr>
        <th>Module Code</th>
        <th>Module Name</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($modules as $module): ?>
    <tr>
        <td><?=$module['module_code']?></td>
        <td><?=$module['module_name']?></td>
        <td>
            <a href="editmodule.php?id=<?=$module['module_id']?>" class="edit-link">Edit</a>

            <form action="deletemodule.php" method="post" onsubmit="return confirmDelete('module');" class="small-form">
                <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
                <input type="submit" value="Delete" class="delete-btn">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>