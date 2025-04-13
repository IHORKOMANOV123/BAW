<?php
require_once 'init.php';

use app\controllers\LoginController;
use app\controllers\CalcController;

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $ctrl = new LoginController();
        $ctrl->show();
        break;

    case 'doLogin':
        $ctrl = new LoginController();
        $ctrl->doLogin();
        break;

    case 'calc':
        $ctrl = new CalcController();
        $ctrl->show();
        break;

    case 'doCalc':
        $ctrl = new CalcController();
        $ctrl->doCalc();
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?action=login");
        break;

    default:
        echo "Nieznana akcja!";
}
