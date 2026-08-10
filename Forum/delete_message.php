<?php
session_start();
include 'includes/DatabaseConnection.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['message_id'])) {
    $messageId = (int)$_POST['message_id'];

    $sql = 'DELETE FROM contact_messages WHERE message_id = :message_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':message_id', $messageId, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: admin_messages.php');
exit();