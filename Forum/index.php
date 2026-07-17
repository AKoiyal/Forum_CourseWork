<?php
$title = 'Home';

ob_start();
?>
<h2>Welcome to Student Help Forum</h2>

<div class="home-box">
    <p>This website allows students to post coursework questions, upload screenshot names, manage users, manage modules, and contact the administrator.</p>
    <p>Use the menu above to navigate through the system.</p>
</div>
<?php
$output = ob_get_clean();

include 'templates/layout.html.php';