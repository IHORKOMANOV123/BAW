<?php
session_start();
require 'config.php';
require_once 'smarty.class.php';

$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir  = 'templates_c/';
$smarty->cache_dir    = 'cache/';
$smarty->config_dir   = 'configs/';

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

$smarty->assign('error', isset($error) ? $error : '');
$smarty->display('login.tpl');
?>
