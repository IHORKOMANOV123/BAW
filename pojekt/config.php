<?php
// Correct configuration based on your server error
define('_SERVER_NAME', 'localhost');  // Changed from localhost:8080 to localhost
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/kredyt');  // Assuming your project folder is named 'kredyt'
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));
?>