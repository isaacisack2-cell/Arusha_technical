<?php
require 'config.php';
if(isset($_POST['verifyBtn']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $adno = htmlspecialchars(trim($_POST['verifyAdno']));
    $sql = $pdo->prepare("SELECT * FROM student Where Adno=?");
    $sql->execute([$adno]);
    $result = $sql->fetch();
    if($result){
        $email = $result['Email'];
        echo "<a href='mailto:{$email}?subject=ATC-SMS%20RECOVERY%20PASSWORD&body=Your%20password%20is%201234'>click here</a> to get recovery email";
    }else{
        echo "not registered";
    }
}
?>