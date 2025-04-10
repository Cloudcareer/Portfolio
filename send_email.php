<?php
header('Content-Type: application/json');

// Your email where you want to receive messages
$to = 'cloudcareeraws@gmail.com';

// Collect form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Validate inputs
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email format']);
    exit;
}

// Prepare email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Prepare email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Subject: $subject\n\n";
$email_content .= "Message:\n$message\n";

// Send email
$mail_sent = mail($to, $subject, $email_content, $headers);

if ($mail_sent) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to send email']);
}
?>