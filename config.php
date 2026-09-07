<?php
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
]);
session_start();

function requireRole(string $role): void
{
    if (($_SESSION['role'] ?? null) !== $role || empty($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
}

$host = "localhost";
$user = "isaac";
$password = getenv('ATC_DB_PASSWORD') ?: 'isaacisack206';
$charset = "utf8mb4";
$dbname = "ARUSHA_TECHNICAL";
$message = null;
$error = null;
$pdo = null;

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch(PDOException $e){
    $error = "Database connection is unavailable.";
}