<?php
require_once 'PHPMailer/PHPMailerAutoload.php'; // Make sure to include the PHPMailerAutoload.php file

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$mail = new PHPMailer();

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'your_email@gmail.com'; // SMTP username
$mail->Password = 'your_password'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom($email, $name); // Set sender
$mail->addAddress('rolanlobo901@gmail.com', 'Your Name'); // Add a recipient
$mail->addReplyTo($email, $name); // Set reply-to

$mail->isHTML(true); // Set email format to HTML

$mail->Subject = $m_subject;
$mail->Body = "You have received a new message from your website contact form.<br><br>Here are the details:<br><br>Name: $name<br><br>Email: $email<br><br>Subject: $m_subject<br><br>Message: $message";

if(!$mail->send()) {
  echo 'Sorry, it seems that our mail server is not responding. Please try again later!';
  http_response_code(500);
} else {
  echo 'Thank you for contacting me! I will get back to you soon.';
}
?>