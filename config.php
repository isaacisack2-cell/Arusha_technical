<?php
session_start();

try{
    $host = "localhost";
    $user = "isaac";
    $password = "isaacisack206";
    $charset = "utf8mb4";
    $dbname = "ARUSHA_TECHNICAL";
    $message = null;
    $error = null;

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch(PDOException $e){
    $error = "error during connection".$e->getMessage();
}