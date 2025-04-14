<?php
require_once 'init.php';

use app\controllers\LoginController;
use app\controllers\CalcController;

$router = new Router();

$router->addRoute('login', LoginController::class, 'show');
$router->addRoute('doLogin', LoginController::class, 'doLogin');
$router->addRoute('logout', LoginController::class, 'logout');

$router->addRoute('calc', CalcController::class, 'show', ['admin', 'user']);
$router->addRoute('doCalc', CalcController::class, 'doCalc', ['admin', 'user']);

$router->go();
