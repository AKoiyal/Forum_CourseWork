<h2>Edit User</h2>

<form action="" method="post">
    <input type="hidden" name="user_id" value="<?=$user['user_id']?>">

    <label for="username">Username</label>
    <input type="text" name="username" id="username"
           value="<?=$user['username']?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email"
           value="<?=$user['email']?>" required>

    <input type="submit" value="Update User">
</form>