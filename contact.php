<?php
require_once __DIR__ . '/mailer.php';

$senderEmail = 'isaacisack2@gmail.com';
$senderName = 'ISAAC TECH SOLUTION';
$admissionPhone = '+255619552706';
$status = null;
$statusType = 'success';

function sendSms(string $message): void
{
    $accountSid = getenv('ATC_SMS_ACCOUNT_SID');
    $authToken = getenv('ATC_SMS_AUTH_TOKEN');
    $from = getenv('ATC_SMS_FROM');
    $to = getenv('ATC_SMS_TO') ?: '+255619552706';
    if (!$accountSid || !$authToken || !$from) {
        throw new RuntimeException('SMS is not configured. Set ATC_SMS_ACCOUNT_SID, ATC_SMS_AUTH_TOKEN and ATC_SMS_FROM.');
    }
    if (!function_exists('curl_init')) {
        throw new RuntimeException('The PHP cURL extension is required for SMS.');
    }

    $curl = curl_init('https://api.twilio.com/2010-04-01/Accounts/' . rawurlencode($accountSid) . '/Messages.json');
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(['To' => $to, 'From' => $from, 'Body' => $message]),
        CURLOPT_USERPWD => $accountSid . ':' . $authToken,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
    ]);
    $response = curl_exec($curl);
    $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($response === false || $httpCode < 200 || $httpCode >= 300) {
        throw new RuntimeException('The SMS provider could not deliver the message.');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    try {
        if ($action === 'email') {
            $recipient = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
            $message = trim($_POST['message'] ?? '');
            if (!$recipient || $message === '') {
                throw new InvalidArgumentException('Enter a valid email address and message.');
            }
            sendProjectEmail($recipient, 'Message from ISAAC TECH SOLUTION', $message);
            $status = 'Email sent successfully.';
        } elseif ($action === 'sms') {
            $message = trim($_POST['sms'] ?? '');
            if ($message === '') {
                throw new InvalidArgumentException('Enter an SMS message.');
            }
            sendSms($message);
            $status = 'SMS sent successfully.';
        }
    } catch (Throwable $exception) {
        $status = $exception->getMessage();
        $statusType = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC - CONTACTS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body class="contact-page">
<div class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
        <a href="index.php" class="nav-brand">HOME</a>
        <a href="about.php" class="nav-brand">ABOUT US</a>
        <a href="login.php" class="nav-brand">SIGNIN</a>
    </div>
</div>

<div class="container contact-shell">
    <?php if ($status !== null): ?>
        <div class="alert alert-<?php echo htmlspecialchars($statusType, ENT_QUOTES, 'UTF-8'); ?>" role="alert">
            <?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <h3 class="contact-heading text-center">CONTACT US <br>
        <span class="text-success">
            <img src="pictures/atc logo.png" alt="ATC LOGO" class="logo">
            <span class="college-name">Arusha Technical College</span>
        </span>
    </h3>
    <div class="row">
        <div class="col-6 col-md-4">
            <div class="card contact-card">
                <div class="card-body">
                    <h5 class="card-title">Send Email</h5>
                    <p class="card-text">Enter your message</p>
                    <form method="post">
                        <input type="hidden" name="action" value="email">
                        <label for="email" class="form-label">Your email address</label>
                        <input type="email" name="email" id="email" class="form-control mb-3" required autocomplete="email">
                        <textarea name="message" id="message" cols="30" rows="4" class="form-control" required></textarea>
                        <button type="submit" class="btn contact-action mt-4 w-100">SEND EMAIL</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="card contact-card">
                <div class="card-body">
                    <h5 class="card-title">Send SMS</h5>
                    <p class="card-text">Enter your SMS message to send</p>
                    <form method="post">
                        <input type="hidden" name="action" value="sms">
                        <textarea name="sms" id="sms" cols="30" rows="4" class="form-control" required></textarea>
                        <button type="submit" class="btn contact-action mt-4 w-100">SEND SMS</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card contact-card">
                <div class="card-body">
                    <h5 class="card-title">MAKE A PHONE CALL</h5>
                    <p class="card-text call-copy">This will make a direct dial phone call to the admission office.</p>
                    <a class="btn contact-action mt-4 w-100" href="tel:<?php echo htmlspecialchars($admissionPhone, ENT_QUOTES, 'UTF-8'); ?>">CALL <?php echo htmlspecialchars($admissionPhone, ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
