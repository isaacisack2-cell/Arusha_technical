<?php
require 'config.php';
require_once __DIR__ . '/mailer.php';

$senderEmail = 'isaacisack2@gmail.com';
$senderName = 'ISAAC TECH SOLUTION';
$message = null;
$error = null;
$verifiedAdno = $_SESSION['password_reset_adno'] ?? null;

function createTemporaryPassword(): string
{
    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';
    $password = '';
    for ($index = 0; $index < 12; $index++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $password;
}

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST' && ($_POST['action'] ?? '') === 'verify_adno') {
    $adno = trim($_POST['adno'] ?? '');
    if ($adno === '' || !preg_match('/^[0-9]+$/', $adno)) {
        unset($_SESSION['password_reset_adno']);
        $verifiedAdno = null;
        $error = 'Tafadhali weka admission number sahihi.';
    } else {
        try {
            $studentQuery = $pdo->prepare('SELECT Email FROM student WHERE Adno = :adno LIMIT 1');
            $studentQuery->execute([':adno' => $adno]);
            $student = $studentQuery->fetch();
            if (!$student || !filter_var($student['Email'] ?? '', FILTER_VALIDATE_EMAIL)) {
                unset($_SESSION['password_reset_adno']);
                $verifiedAdno = null;
                $error = 'Admission number haipo au haina email sahihi kwenye mfumo.';
            } else {
                $_SESSION['password_reset_adno'] = $adno;
                $verifiedAdno = $adno;
            }
        } catch (Throwable $exception) {
            unset($_SESSION['password_reset_adno']);
            $verifiedAdno = null;
            $error = 'Mfumo haukuweza kuthibitisha admission number.';
        }
    }
}

if ($requestMethod === 'POST' && isset($_POST['reset_password'])) {
    try {
        $adno = $_SESSION['password_reset_adno'] ?? null;
        if (!$adno) {
            throw new InvalidArgumentException('Anza kwa kuthibitisha admission number kwanza.');
        }

        $studentQuery = $pdo->prepare('SELECT Email FROM student WHERE Adno = :adno LIMIT 1');
        $studentQuery->execute([':adno' => $adno]);
        $student = $studentQuery->fetch();
        $email = filter_var($student['Email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$student || !$email) {
            throw new InvalidArgumentException('Student account au email haikupatikana.');
        }

        $temporaryPassword = createTemporaryPassword();
        $passwordHash = password_hash($temporaryPassword, PASSWORD_DEFAULT);
        $pdo->beginTransaction();
        $passwordUpdate = $pdo->prepare('UPDATE student SET Password = :password WHERE Adno = :adno');
        $passwordUpdate->execute([':password' => $passwordHash, ':adno' => $adno]);
        sendProjectEmail(
            $email,
            'ATC-SMS temporary password',
            "Your ATC-SMS temporary password is: " . $temporaryPassword
                . "\r\n\r\nLog in using this password and change it from your student services page."
                . "\r\n\r\n" . $senderName
        );
        $pdo->commit();
        unset($_SESSION['password_reset_adno']);
        $message = 'Temporary password imetumwa kwenye email iliyosajiliwa kwenye account yako.';
    } catch (Throwable $exception) {
        if ($pdo instanceof PDO && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $error = $exception instanceof InvalidArgumentException
            ? $exception->getMessage()
            : 'Reset haikukamilika. Tafadhali jaribu tena au wasiliana na admissions.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Temporary Password | ATC-SMS</title>
    <style>
        :root { --navy: #123b2a; --green: #198754; --green-dark: #12633e; --gold: #e7b84b; --paper: #f2f8f4; --muted: #62786b; --line: #d4e5da; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--navy); background: radial-gradient(circle at 10% 0%, #d9f0df, transparent 32%), linear-gradient(135deg, #f2f8f4, #e4f0e8); font-family: "Trebuchet MS", "Segoe UI", sans-serif; }
        a { color: inherit; text-decoration: none; }
        .topbar { display: flex; align-items: center; justify-content: space-between; width: min(1100px, calc(100% - 2rem)); margin: auto; padding: 1.2rem 0; }
        .brand { display: flex; align-items: center; gap: 0.7rem; font-size: 0.84rem; font-weight: 800; letter-spacing: 0.05em; }
        .brand img { width: 42px; height: 42px; object-fit: contain; }
        .back-link { color: var(--green-dark); font-size: 0.82rem; font-weight: 800; }
        .page { display: grid; grid-template-columns: 0.9fr 1.1fr; width: min(1000px, calc(100% - 2rem)); min-height: calc(100vh - 82px); margin: auto; padding: 3rem 0 5rem; align-items: center; gap: 4rem; }
        .intro { padding-bottom: 2rem; }
        .eyebrow { color: #d18c20; font-size: 0.73rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; }
        h1 { max-width: 420px; margin: 0.7rem 0 1rem; font-family: Georgia, serif; font-size: clamp(2.7rem, 6vw, 4.7rem); font-weight: 500; line-height: 1; letter-spacing: -0.04em; }
        .intro p { max-width: 410px; color: var(--muted); font-size: 1rem; }
        .notice { display: flex; gap: 0.8rem; align-items: flex-start; max-width: 410px; margin-top: 2rem; padding: 1rem; border-left: 3px solid var(--green); color: var(--muted); background: rgba(255,255,255,0.62); font-size: 0.8rem; }
        .notice strong { display: block; margin-bottom: 0.2rem; color: var(--navy); }
        .card { padding: clamp(1.5rem, 4vw, 3rem); border: 1px solid rgba(25,135,84,0.15); background: rgba(255,255,255,0.9); box-shadow: 0 25px 65px rgba(18,59,42,0.14); }
        .card h2 { margin: 0 0 0.5rem; font-family: Georgia, serif; font-size: 2rem; font-weight: 500; }
        .card-copy { margin-bottom: 1.8rem; color: var(--muted); font-size: 0.9rem; }
        .alert { margin-bottom: 1.2rem; padding: 0.85rem 1rem; border-left: 4px solid; font-size: 0.82rem; }
        .alert-success { border-color: var(--green); color: #17603f; background: #e1f3e7; }
        .alert-error { border-color: #c65348; color: #963b35; background: #fbe9e7; }
        .reset-button { display: block; width: 100%; margin-top: 1rem; padding: 0.9rem 1rem; border: 0; border-radius: 4px; color: #ffffff; background: var(--green); font: inherit; font-weight: 800; letter-spacing: 0.04em; cursor: pointer; transition: transform 180ms ease, background 180ms ease; }
        .reset-button:hover, .reset-button:focus { background: var(--green-dark); transform: translateY(-2px); }
        .reset-button:disabled { cursor: not-allowed; opacity: 0.55; transform: none; }
        .privacy-note { margin: 1.3rem 0 0; color: var(--muted); font-size: 0.72rem; line-height: 1.55; }
        @media (max-width: 760px) { .page { grid-template-columns: 1fr; gap: 1.5rem; padding-top: 2rem; } .intro { padding-bottom: 0; } h1 { max-width: 500px; } }
        @media (max-width: 450px) { .topbar { width: min(100% - 1.3rem, 1100px); } .page { width: min(100% - 1.3rem, 1000px); } .brand { font-size: 0.7rem; } .back-link { font-size: 0.74rem; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="index.php"><img src="pictures/atc logo.png" alt="ATC crest">ATC-SMS</a>
        <a class="back-link" href="login.php">Back to login</a>
    </header>

    <main class="page">
        <section class="intro">
            <div class="eyebrow">Step two · Password recovery</div>
            <h1>Request your temporary password.</h1>
            <p>Weka admission number yako hapa chini. Ikiwa ipo kwenye mfumo, utaweza kuomba temporary password itumwe kwenye email yako.</p>
            <div class="notice"><div><strong>Remember</strong>Angalia inbox na spam folder baada ya kutuma ombi.</div></div>
        </section>

        <section class="card" aria-labelledby="reset-title">
            <h2 id="reset-title">Request temporary password</h2>
            <p class="card-copy">Password mpya itawekwa kwenye account yako na kutumwa kwa email iliyothibitishwa.</p>
            <?php if ($message !== null): ?>
                <div class="alert alert-success" role="status"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if ($error !== null): ?>
                <div class="alert alert-error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if ($verifiedAdno && $message === null): ?>
                <button class="reset-button" type="submit" form="reset-form">SEND TEMPORARY PASSWORD TO MY EMAIL</button>
                <form method="post" id="reset-form">
                    <input type="hidden" name="reset_password" value="1">
                </form>
            <?php elseif ($message === null): ?>
                <form method="post">
                    <label for="adno">Admission number</label>
                    <input type="text" id="adno" name="adno" inputmode="numeric" pattern="[0-9]+" autocomplete="username" required placeholder="Enter your admission number">
                    <input type="hidden" name="action" value="verify_adno">
                    <button class="reset-button" type="submit">VERIFY ADMISSION NUMBER</button>
                </form>
            <?php endif; ?>
            <p class="privacy-note">Temporary password haionyeshwi kwenye ukurasa huu kwa usalama. Baada ya kuingia, ibadilishe kupitia student services.</p>
        </section>
    </main>
</body>
</html>
