<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function sendProjectEmail(string $recipient, string $subject, string $body): void
{
    $smtpPassword = getenv('ATC_SMTP_PASSWORD');
    if (!$smtpPassword) {
        throw new RuntimeException('Email service is not configured. Set ATC_SMTP_PASSWORD on the server.');
    }

    $mailer = new PHPMailer(true);
    try {
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'isaacisack2@gmail.com';
        $mailer->Password = $smtpPassword;
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port = 587;
        $mailer->CharSet = 'UTF-8';
        $mailer->setFrom('isaacisack2@gmail.com', 'ISAAC TECH SOLUTION');
        $mailer->addAddress($recipient);
        $mailer->Subject = $subject;
        $mailer->isHTML(false);
        $mailer->Body = $body;
        $mailer->send();
    } catch (Exception $exception) {
        throw new RuntimeException('The email service could not deliver the message.');
    }
}
