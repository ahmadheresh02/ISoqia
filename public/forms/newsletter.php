<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Correct autoload path (adjust if your file is in a subfolder)
require __DIR__ . '/../../vendor/autoload.php';

$mail = new PHPMailer(true);
$receiving_email_address = 'leoqu.22@gmail.com'; // Your email

try {
    // SMTP Configuration (Gmail example)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-gmail@gmail.com'; // Your Gmail
    $mail->Password = 'your-app-password'; // Use App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email content
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress($receiving_email_address);
    $mail->Subject = $_POST['subject'];
    $mail->Body = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\nPhone: {$_POST['phone']}\nMessage: {$_POST['message']}";

    $mail->send();
    echo "Your message has been sent!";
} catch (Exception $e) {
    echo "Error: Message not sent. Mailer Error: {$mail->ErrorInfo}";
}
?>