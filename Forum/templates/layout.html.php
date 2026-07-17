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

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
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
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            background: #eafaf1;
            border: 1px solid #b7e4c7;
            color: #1e6b3a;
        }

        @media (max-width: 768px) {
            main {
                margin: 15px;
                padding: 18px;
            }

            nav a {
                display: inline-block;
                margin-bottom: 10px;
            }

            header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Student Help Forum</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="posts.php">Posts</a>
        <a href="addpost.php">Add Post</a>
        <a href="users.php">Users</a>
        <a href="modules.php">Modules</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>

<main>
    <?=$output?>
</main>

<script>
    function confirmDelete(itemName) {
        return confirm('Are you sure you want to delete this ' + itemName + '?');
    }
</script>

</body>
</html>