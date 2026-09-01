<?php

    if(!isset($_SESSION['username']) || !isset($_COOKIE['role']) || !$_COOKIE['role'] != "admin"){
        header("location:login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

</body>
</html>