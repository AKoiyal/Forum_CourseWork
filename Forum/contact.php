<?php
$title = 'Contact admin';

if (isset($_POST['message'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $to = 'your-email@example.com';
    $subject = 'Message from Student Help Forum';

    $fullMessage = "Username: " . $username . "\n";
    $fullMessage .= "Email: " . $email . "\n\n";
    $fullMessage .= "Message:\n" . $message;

    $headers = 'From: ' . $email;

    mail($to, $subject, $fullMessage, $headers);

    $output = '<p class="message">Message sent successfully.</p>';
}
else {
    ob_start();
    include 'templates/contact.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';