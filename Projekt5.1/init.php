<?php
session_start();

require_once 'config.php';
require_once 'functions.php';

spl_autoload_register(function($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.class.php';

    if (file_exists($file)) {
        require $file;
    }
});
