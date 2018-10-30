<?php

/*
 * App Core Class
 * Creates URL & loads main controller
 * URL FORMAT - /controller/method/params
 */

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $urlParts = $this->getUrl();
        // Look in controllers for first part
        if (file_exists(__DIR__ . '/../controllers/' . ucwords($urlParts[0]) . '.php')) {
            // If exists, set as controller
            $controller = ucwords($urlParts[0]);

            // Require the controller
            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            // Unset 0 index
            unset($urlParts[0]);

            // Check for second part of url and if method exists in controller
            if (!empty($urlParts[1]) && method_exists($controller, $urlParts[1])) {
                $method = $urlParts[1];
                $this->currentMethod = $method;
                unset($urlParts[1]);
            }

            if(method_exists($controller, $this->currentMethod)) {
                $this->currentController = $controller;
            }
        }

        // Set params
        $this->params = $urlParts ? array_values($urlParts) : [];
        call_user_func_array([new $this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (!empty($_GET['url'])) {
            $url = filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
}