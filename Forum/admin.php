<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

$title = 'Admin Area';

ob_start();
?>
<h2>Admin Area</h2>
<p>Welcome, <?=$_SESSION['username']?>.</p>

<ul>
    <li><a href="admin_messages.php">View messages</a></li>
    <li><a href="posts.php">Manage posts</a></li>
    <li><a href="users.php">Manage users</a></li>
    <li><a href="modules.php">Manage modules</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<?php
$output = ob_get_clean();

include 'templates/layout.html.php';