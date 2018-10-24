<?php

// Load config
require_once __DIR__ . '/config/config.php';

// Load Core Libraries
spl_autoload_register(function($class) {
    require_once __DIR__ . '/libraries/' . $class . '.php';
});