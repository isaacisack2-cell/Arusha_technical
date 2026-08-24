<?php

if(isset($_COOKIE['role']) && isset($_SESSION['username']) && $_COOKIE['username'] == "student"){
    header("location:student_dashboard.php");
    exit();
}

try{
    require "config.php";
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])){
        $name = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars($_POST['password']);

        $sql = $pdo->prepare("SELECT * FROM student WHERE adno = :adno OR Fname = :fname");
        $sql->execute([
            ':adno' => $name,
            ':fname' => $name
        ]);
        $result = $sql->fetch();
        if($result){
            if(password_verify($password,$result['Password']) || $password == $result['Password']){
                $_SESSION['username'] = $result;
                setcookie('role',"student",time() + 3600,"/",httponly:true,secure:true);
                header("location:student_dashboard.php");
            }else{
                $error = "Invalid credentials Username or password is incorrect";
            }
        }else{
            $error = "User not found";
        }
    }
}catch(TypeError $e){
    $error = "ERROR OCCURED".$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC-SMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="post" id="login_form">
            <img src="./pictures/atc logo.png" alt="ATC LOGO" id="atc_logo">
            <h1 style="text-align: center;">ATC-SMS</h1>
            <P style="text-align: center;">Student Management System</P>
            <div class="input-group">
                <span>👔</span>
                <input type="text" name="username" placeholder="Username" required>
                <span class="tick" id="tick1"></span>
            </div>
            <div class="input-group">
                <span>🔏</span>
                <input type="password" name="password" placeholder="Password" required>
                <span class="tick" id="tick2"></span>
            </div>
            <p>forgot password?<a href="reset.html">Reset</a></p>
            <p>are you first year student?<a href="signin.php">Sign Up</a></p>
            <input type="submit" value="Login" id="login_btn" name="login">
            <?php include "status_box.php"; ?>
            <p>Enquiries: 📞 0734 602 000 | ✉️ admissions@atc.ac.tz</p>
        </form>
    </div>

    <script src="./login.js"></script>
</body>
</html>