<?php

function getFromSession($key) {
    return $_SESSION[$key] ?? null;
}

function setInSession($key, $value) {
    $_SESSION[$key] = $value;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function getUser() {
    return $_SESSION['user'] ?? null;
}

function hasRole($role) {
    return getFromSession('role') === $role;
}

function redirectTo($action) {
    header("Location: index.php?action=$action");
    exit();
}
