<?php
require_once 'init.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        getDB()->delete('person', ['idperson' => $id]);
    } catch (Exception $e) {
        // логировать ошибку при необходимости
    }
}

header('Location: list.php');
exit;

