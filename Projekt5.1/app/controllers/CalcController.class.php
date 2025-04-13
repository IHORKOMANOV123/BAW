<?php

namespace app\controllers;

class CalcController {

    public function show() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit();
        }

        include 'app/views/calc.tpl.php';
    }

    public function doCalc() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $kwota = floatval($_POST['kwota'] ?? 0);
        $lat = intval($_POST['raty'] ?? 0);
        $procent = floatval($_POST['procent'] ?? 0);
        $messages = [];
        $rata = null;

        if ($kwota <= 0) $messages[] = "Kwota musi być większa od zera.";
        if ($lat <= 0) $messages[] = "Okres (lata) musi być większy od zera.";
        if ($procent < 0) $messages[] = "Oprocentowanie nie może być ujemne.";

        if (empty($messages)) {
            $n = $lat * 12;
            $r = $procent / 100;
            $kwota_do_splaty = $kwota + ($kwota * $r * $lat);
            $rata = round($kwota_do_splaty / $n, 2);
        }

        include 'app/views/calc.tpl.php';
    }
}
