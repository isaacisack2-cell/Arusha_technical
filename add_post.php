<?php
try{
require "config.php";
$file_name = $_FILES['file']['name'];
$temp_file = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_error = $_FILES['file']['error'];
$dir = "./posts/";
$file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
$allowed_extensions = ['jpg','jpeg','png','pdf','mp4','gif'];
if($file_error == 0){
    if(in_array($file_extension,$allowed_extensions)){
        if($file_size < 5*1024*1024){
            $post_name = $dir.uniqid("",true).$file_extension;
            if(move_uploaded_file($temp_file,$post_name)){
                $sql = $pdo->prepare("INSERT INTO posts(name,description) VALUES (:name,:desc)");
                $sql->execute([
                    ':name' => $post_name,
                    ':desc' => htmlspecialchars(trim($_POST['description']))
                ]);
                $message = "FILE UPLOADED SUCCESSFULL";
            }else{
                $error = "failed to upload your file";
            }
        }else{
            $error = "file greater than 5MB are not allowed";
        }
    }else{
        $error = "file extension .{$file_extension} are not allowed";
    }
}else{
    $error = "error during processing the file";
}

include "status_box.php";

}catch(PDOException $e){
    $error = "ERROR ".$e->getMessage();
}
?>