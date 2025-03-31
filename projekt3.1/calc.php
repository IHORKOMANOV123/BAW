<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
require 'config.php';
require_once 'smarty.class.php';

$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir  = 'templates_c/';
$smarty->cache_dir    = 'cache/';
$smarty->config_dir   = 'configs/';

$kwota = null;
$lat = null;
$procent = null;
$rata = null;
$messages = array();

getParams($kwota, $lat, $procent);
if (validate($kwota, $lat, $procent, $messages)) {
    function process(&$kwota, &$lat, &$procent, &$messages, &$rata) {
        $n = $lat * 12;
        $r = ($procent / 100);
        $kwota_do_splaty = $kwota + ($kwota * $r * $lat);
        $rata = $kwota_do_splaty / $n;
        $rata = round($rata, 2);
    }
    process($kwota, $lat, $procent, $messages, $rata);
}

$smarty->assign('kwota', $kwota);
$smarty->assign('lat', $lat);
$smarty->assign('procent', $procent);
$smarty->assign('rata', $rata);
$smarty->assign('messages', $messages);
$smarty->display('calc.tpl');
?>
