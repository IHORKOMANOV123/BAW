<?php

// Конфигурация пользователей
$config = [
    'users' => [
        'admin' => ['pass' => 'admin', 'role' => 'admin'],
        'user'  => ['pass' => 'user',  'role' => 'user']
    ]
];

// Подключение Medoo
require_once __DIR__ . '/lib/medoo.php';

use Medoo\Medoo;

// Функция подключения к БД
function getDB() {
    static $db = null;
    if ($db === null) {
        $db = new Medoo([
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'simpledb',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ]);
    }
    return $db;
}
