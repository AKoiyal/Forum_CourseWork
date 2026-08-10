<?php
session_start();
include 'includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('location: login.php');
    exit();
}

$title = 'Message';

$error = '';
$success = '';

if (isset($_POST['message_text'])) {
    $userId = $_SESSION['user_id'];
    $messageText = trim($_POST['message_text']);

    if ($messageText === '') {
        $error = 'Message cannot be empty.';
    } else {
        $sql = 'INSERT INTO contact_messages SET
                    user_id = :user_id,
                    message = :message';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':message', $messageText);
        $stmt->execute();

        $success = 'Your message has been sent to the administrator.';
    }
}

$sql = 'SELECT message, created_at
        FROM contact_messages
        WHERE user_id = :user_id
        ORDER BY created_at DESC';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['user_id']);
$stmt->execute();

$messages = $stmt->fetchAll();

ob_start();
include 'templates/student_messages.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';