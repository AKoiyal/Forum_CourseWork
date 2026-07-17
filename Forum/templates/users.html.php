<h2>User List</h2>

<p>
    <a href="adduser.php" class="button-link">Add New User</a>
</p>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?=$user['username']?></td>
        <td><?=$user['email']?></td>
        <td>
            <a href="edituser.php?id=<?=$user['user_id']?>" class="edit-link">Edit</a>

            <form action="deleteuser.php" method="post" onsubmit="return confirmDelete('user');" class="small-form">
                <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                <input type="submit" value="Delete" class="delete-btn">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>