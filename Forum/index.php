<?php
session_start();
include 'includes/DatabaseConnection.php';

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = $isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$isStudent = $isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'student';

$title = 'Home';

ob_start();
?>

<h2>Welcome to Student Help Forum</h2>

<div class="home-box">
    <?php if (!$isLoggedIn): ?>
        <p>You are browsing as a guest.</p>
        <p>Please <a href="login.php">login</a> to post or send messages.</p>
    <?php elseif ($isStudent): ?>
        <p>Welcome, <?=$_SESSION['username']?>!</p>
        <p>Use the menu to browse posts, users, modules, and messages.</p>
    <?php elseif ($isAdmin): ?>
    <p>Welcome, <?=$_SESSION['username']?>!</p>
    <p>Use the menu to manage posts, users, modules, and messages.</p>
<?php endif; ?>
</div>

<?php
$output = ob_get_clean();
include 'templates/layout.html.php';