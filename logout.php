<?php
session_start();
session_abort();
session_unset();
session_destroy();
setcookie('role','student',time() - 3650,"/",true,true);
header("location:login.php");
exit();

?>