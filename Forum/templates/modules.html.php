<h2>Module List</h2>

<?php
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin    = $isLoggedIn && $_SESSION['role'] === 'admin';
?>

<?php if ($isAdmin): ?>
    <p>
        <a href="addmodule.php" class="button-link">Add New Module</a>
    </p>
<?php endif; ?>

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
            <?php if ($isAdmin): ?>
                <a href="editmodule.php?id=<?=$module['module_id']?>" class="edit-link">Edit</a>

                <form action="deletemodule.php" method="post" onsubmit="return confirmDelete('module');" class="small-form">
                    <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
                    <input type="submit" value="Delete" class="delete-btn">
                </form>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>