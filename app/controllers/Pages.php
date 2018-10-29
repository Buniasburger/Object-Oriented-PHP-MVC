<?php

class Pages extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple social network buil on the TraversyMVC PHP framework'
        ];
        $this->view('pages/index', $data);
    }

    public function about(): void
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about', $data);
    }
}