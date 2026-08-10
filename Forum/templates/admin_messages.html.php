<h2>Student Messages</h2>

<?php if (count($messages) === 0): ?>
    <p>No messages found.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Student</th>
            <th>Email</th>
            <th>Content</th>
            <th>Sent at</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($messages as $m): ?>
        <tr>
            <td><?=$m['username']?></td>
            <td><?=$m['email']?></td>
            <td><?=nl2br(htmlspecialchars($m['content']))?></td>
            <td><?=$m['created_at']?></td>
            <td>
                <a href="mailto:<?=$m['email']?>?subject=Reply from Admin" class="edit-link">Reply</a>

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