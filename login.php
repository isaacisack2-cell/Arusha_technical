<?php
require "config.php";

if (isset($_SESSION['username'], $_SESSION['role'])) {
    if ($_SESSION['role'] === 'student') {
        header("location:student_dashboard.php");
        exit();
    }
    if ($_SESSION['role'] === 'admin') {
        header("location:admin_dashboard.php");
        exit();
    }
}

$error = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $name = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (strcasecmp($name, 'admin') === 0 && $password === 'admin123') {
            $_SESSION['username'] = [
                'adno' => 'ADMIN',
                'Fname' => 'System',
                'Lname' => 'Administrator',
                'Email' => 'isaacisack2@gmail.com'
            ];
            $_SESSION['role'] = 'admin';
            header('location:admin_dashboard.php');
            exit();
        }

        $sql = $pdo->prepare("SELECT * FROM student WHERE adno = :adno OR Fname = :fname LIMIT 1");
        $sql->execute([
            ':adno' => $name,
            ':fname' => $name
        ]);
        $result = $sql->fetch();

        if ($result) {
            $storedPassword = $result['Password'] ?? $result['password'] ?? '';
            if (password_verify($password, $storedPassword)) {
                session_regenerate_id(true);
                $_SESSION['username'] = $result;
                $_SESSION['role'] = 'student';
                $_SESSION['student_photo'] = $result['Photo'] ?? $result['photo'] ?? 'pictures/atclogo.png';
                header('location:student_dashboard.php');
                exit();
            }
            $error = 'Invalid credentials. Username or password is incorrect.';
        } else {
            $error = 'User not found.';
        }
    }
} catch (Throwable $e) {
    $error = 'ERROR OCCURED: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC-SMS</title>
    <style>
        .bx{font-size: 1.5rem;}
        #card{background-color: rgba(230,235,235,0.8);}
    </style>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\boxicons.min.css">
    
</head>
<body>
    <div class="container p-5 mt-5">
        <div class="row">
            <div class="col-1 col-md-3"></div>
            <div id="card" class="card col-10 col-md-6 p-5 ml-5 box-shadow">
                <form method="post" id="login_form">
                    <div class="row">
                        <div class="col-4"></div>
                        <img src="./pictures/atc logo.png" alt="ATC LOGO" id="atc_logo" class="col-4">
                        <div class="col-4"></div>
                    </div>
                    <h1 style="text-align: center;">ATC-SMS</h1>
                    <P style="text-align: center;">Student Management System</P>

                    <div class="input-group">
                        <span><i class="bx bx-user"></i></span>
                        <input type="text" name="username" placeholder="Username" required class="form-control mb-3">
                        <span class="tick" id="tick1"></span>
                    </div>
                    
                    <div class="input-group">
                        <span><i class="bx bx-lock"></i></span>
                        <input type="password" name="password" placeholder="Password" required class="form-control">
                        <span class="tick" id="tick2"></span>
                    </div>

                    <p>forgot password?<a href="reset.html">Reset</a></p>
                    <p>are you first year student?<a href="register.php">Sign Up</a></p>
                    <p class="text-muted">Need help? Contact admissions for account support.</p>
                    <input type="submit" value="Login" id="login_btn" name="login" class="btn btn-success w-100">
                    <?php include "status_box.php"; ?>
                    <p>Enquiries: 📞 0734 602 000 | ✉️ admissions@atc.ac.tz</p>
                </form>
            </div>
        </div>
    </div>

    <script src="./login.js"></script>
</body>
</html>