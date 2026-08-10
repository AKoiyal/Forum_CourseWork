<?php
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = $isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$isStudent = $isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        header h1 {
            margin: 0 0 12px 0;
            font-size: 28px;
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-left a {
            margin-right: 15px;
        }

        .nav-right a {
            margin-left: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2, h3 {
            color: #2c3e50;
        }

        p {
            line-height: 1.6;
        }

        article {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }

        article:last-child {
            border-bottom: none;
        }

        img {
            max-width: 220px;
            height: auto;
            border-radius: 6px;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        input[type="submit"],
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #2980b9;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .edit-link {
            display: inline-block;
            margin: 8px 0 12px 0;
            color: #2980b9;
            font-weight: bold;
            text-decoration: none;
        }

        .edit-link:hover {
            text-decoration: underline;
        }

        .button-link {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .button-link:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .small-form {
            display: inline;
        }

        .home-box {
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .message {
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .message-error {
            background:#f8d7da;
            border:1px solid #f5c2c7;
            color:#842029;
        }

        .login-wrapper {
            max-width: 400px;
            margin-top: 20px;
        }

        .login-student form {
            margin-top: 10px;
        }

        .login-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }

        .admin-area-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .admin-area-button:hover {
            background-color: #5a6268;
        }

        .admin-popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .admin-popup {
            background: white;
            padding: 20px 24px;
            border-radius: 10px;
            max-width: 360px;
            width: 100%;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        .admin-popup h3 {
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            main {
                margin: 15px;
                padding: 18px;
            }

            header h1 {
                font-size: 22px;
            }

            .main-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .nav-right {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Student Help Forum</h1>
    <nav class="main-nav">
        <div class="nav-left">
            <a href="index.php">Home</a>
            <a href="posts.php">Posts</a>

            <a href="users.php">Users</a>
            <a href="modules.php">Modules</a>

            <?php if ($isStudent): ?>
                <a href="student_messages.php">Message</a>
            <?php elseif ($isAdmin): ?>
                <a href="admin_messages.php">Message</a>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <?php if ($isLoggedIn): ?>
                <a href="logout.php">Logout (<?=$_SESSION['username']?>)</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <?=$output?>
</main>

<script>
    function confirmDelete(itemName) {
        return confirm('Are you sure you want to delete this ' + itemName + '?');
    }

    function openAdminPopup() {
        var overlay = document.getElementById('admin-popup-overlay');
        if (overlay) {
            overlay.style.display = 'flex';
            var input = document.getElementById('admin_password');
            if (input) input.focus();
        }
    }

    function closeAdminPopup() {
        var overlay = document.getElementById('admin-popup-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }
    }
</script>

</body>
</html>