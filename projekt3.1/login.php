<?php
session_start();
require 'config.php'; // Здесь можно подключить функции или настройки, если они требуются

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($username !== '' && $password !== '') {
    if (($username === 'admin' && $password === 'admin') || ($username === 'user' && $password === 'user')) {
        $_SESSION['logged_in'] = true;
        header("Location: calc.php");
        exit;
    } else {
        $error = "Неверные учетные данные";
    }
}

include 'login_view.php';
?>

