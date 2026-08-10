<h2>Message</h2>

<p>Send a message to the administrator.</p>

<?php if (!empty($error)): ?>
    <p class="message message-error"><?=$error?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p class="message" style="background:#eafaf1;border:1px solid #b7e4c7;color:#1e6b3a;">
        <?=$success?>
    </p>
<?php endif; ?>

<form action="" method="post">
    <label>Your name</label>
    <input type="text" value="<?=$_SESSION['username']?>" disabled>

    <label>Your email</label>
    <input type="email" value="<?=$_SESSION['email']?>" disabled>

    <label for="message_text">Your message</label>
    <textarea name="message_text" id="message_text" required></textarea>

    <input type="submit" value="Send message">
</form>

<?php if (!empty($messages)): ?>
    <h3>Your previous messages</h3>
    <ul>
        <?php foreach ($messages as $msg): ?>
            <li>
                <strong><?=$msg['created_at']?></strong><br>
                <?=nl2br(htmlspecialchars($msg['message']))?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>