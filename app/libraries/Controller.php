<?php

/*
 * Base Controller
 * Loads the model and views
 */

class Controller
{
    // Load model
    public function model(string $model)
    {
        // Require model file
        require_once __DIR__ . '/../models/' . $model . '.php';

        // Instantiate model
        return new $model;
    }

    // Load view
    public function view(string $view, array $data = [])
    {
        // Check for view file
        if (file_exists(__DIR__ . '/../views/' . $view . '.php')) {
            require_once __DIR__ . '/../views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}