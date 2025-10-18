<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // after installing PHPMailer via Composer

$mail = new PHPMailer(true);

try {
//Server settings
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'vyshaknsc02@gmail.com';
$mail->Password = 'your-app-password'; // Gmail requires app password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

//Recipients
$mail->setFrom('vyshaknsc02@gmail.com', 'Your Name');
$mail->addAddress('vyshaknsc02@gmail.com', 'Recipient Name');

//Content
$mail->isHTML(true);
$mail->Subject = 'Test Email';
$mail->Body    = '<h1>Hello!</h1><p>This is a test email.</p>';

$mail->send();
echo 'Email sent successfully';
} catch (Exception $e) {
echo "Mailer Error: {$mail->ErrorInfo}";
}
