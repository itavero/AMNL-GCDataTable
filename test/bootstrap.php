<?php

// Output all errors
error_reporting(E_ALL | E_STRICT);

// Base path
define('BASE_PATH', dirname(__DIR__));

// Autoloader
require_once BASE_PATH . '/vendor/autoload.php';