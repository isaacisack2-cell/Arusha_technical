<?php
session_start();
session_abort();
session_unset();
session_destroy();
setcookie('role','user',time() - 3600,"/",true,true);
header("location:login.php");
exit();

?>