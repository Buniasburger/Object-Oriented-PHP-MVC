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
        if(file_exists(__DIR__ . '/../controllers/' . ucwords($urlParts[0]) . '.php')) {
            // If exists, set as controller
            $this->currentController = ucwords($urlParts[0]);
            // Unset 0 index
            unset($urlParts[0]);
        }

        // Require the controller
        require_once __DIR__ . '/../controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;
    }

    public function getUrl()
    {
        if (!empty($_GET['url'])) {
            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
}