<?php
// Add this only once at the top if not already included
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Assuming these values are already set
// $name = $_POST['name'];
// $email = $_POST['email'];

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'esycon.conference@gmail.com';         // 🔁 Your Gmail
    $mail->Password   = 'tbpdkwkcyvcsqirv';    // 🔁 Your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Conference Team');  // Sender
    $mail->addAddress($email, $name);                            // Recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Manuscript Submission Confirmation';
    $mail->Body    = "
        <p>Dear <strong>$name</strong>,</p>
        <p>Thank you for submitting your manuscript. We have received it successfully.</p>
        <p>We will review it and get back to you soon.</p>
        <p>Regards,<br><strong>Conference Team</strong></p>
    ";

    $mail->send();
    echo "✅ Email sent successfully.";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
