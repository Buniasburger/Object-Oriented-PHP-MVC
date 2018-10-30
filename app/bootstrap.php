<?php

// Load config
require_once __DIR__ . '/config/config.php';

// Load helpers
require_once __DIR__ . '/helpers/url_helper.php';
require_once __DIR__ . '/helpers/session_helper.php';

// Load Core Libraries
spl_autoload_register(function($class) {
    require_once __DIR__ . '/libraries/' . $class . '.php';
});