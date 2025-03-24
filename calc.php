<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require 'config.php'; // Подключаем общий файл с функциями

// Получение параметров, валидация и расчёт
$kwota    = null;
$lat      = null;
$procent  = null;
$rata     = null;
$messages = array();

getParams($kwota, $lat, $procent);
if (validate($kwota, $lat, $procent, $messages)) {
    // Новая формула расчёта кредита: равномерное распределение суммы к оплате
    function process(&$kwota, &$lat, &$procent, &$messages, &$rata) {
        $n = $lat * 12;
        $r = ($procent / 100);
        $kwota_do_splaty = $kwota + ($kwota * $r * $lat);
        $rata = $kwota_do_splaty / $n;
        $rata = round($rata, 2);
    }
    process($kwota, $lat, $procent, $messages, $rata);
}

include 'calc_view.php';
?>
