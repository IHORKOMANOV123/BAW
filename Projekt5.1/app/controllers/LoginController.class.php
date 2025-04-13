<?php

namespace app\controllers;

class LoginController {
    public function show() {
        include 'app/views/login.tpl.php';
    }

    public function doLogin() {
        global $config;

        $login = $_POST['login'] ?? '';
        $pass = $_POST['pass'] ?? '';

        if (isset($config['users'][$login]) && $config['users'][$login] === $pass) {
            $_SESSION['user'] = $login;
            header("Location: index.php?action=calc");
        } else {
            $error = "Nieprawidłowy login lub hasło.";
            include 'app/views/login.tpl.php';
        }
    }
}
