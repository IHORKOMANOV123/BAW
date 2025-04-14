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

        if (isset($config['users'][$login]) && $config['users'][$login]['pass'] === $pass) {
            setInSession('user', $login);
            setInSession('role', $config['users'][$login]['role']);
            redirectTo('calc');
        } else {
            $error = "Nieprawidłowy login lub hasło.";
            include 'app/views/login.tpl.php';
        }
    }

    public function logout() {
        session_destroy();
        redirectTo('login');
    }
}
