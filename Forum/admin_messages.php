<?php
session_start();
include 'includes/DatabaseConnection.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$title = 'Admin Messages';


$sql = 'SELECT contact_messages.message_id,
               contact_messages.message,
               contact_messages.created_at,
               users.username,
               users.email
        FROM contact_messages
        JOIN users ON contact_messages.user_id = users.user_id
        ORDER BY contact_messages.created_at DESC';

$result = $pdo->query($sql);

$messages = [];
foreach ($result as $row) {
    $messages[] = [
        'message_id' => $row['message_id'],
        'message'    => $row['message'],
        'created_at' => $row['created_at'],
        'username'   => $row['username'],
        'email'      => $row['email'],
    ];
}

ob_start();
?>
<h2>Student Messages</h2>

<?php if (count($messages) === 0): ?>
    <p>No messages found.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Student</th>
            <th>Email</th>
            <th>Message</th>
            <th>Sent at</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($messages as $m): ?>
        <tr>
            <td><?=$m['username']?></td>
            <td><?=$m['email']?></td>
            <td><?=nl2br(htmlspecialchars($m['message']))?></td>
            <td><?=$m['created_at']?></td>
            <td>
                <!-- Reply bằng email client -->
                <a href="mailto:<?=$m['email']?>?subject=Reply from Admin" class="edit-link">Reply</a>

                <!-- Delete message -->
                <form action="delete_message.php" method="post"
                      onsubmit="return confirmDelete('message');"
                      class="small-form">
                    <input type="hidden" name="message_id" value="<?=$m['message_id']?>">
                    <input type="submit" value="Delete" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php
$output = ob_get_clean();
include 'templates/layout.html.php';