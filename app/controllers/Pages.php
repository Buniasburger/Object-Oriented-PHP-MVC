<?php

class Pages extends Controller
{
    public function index(): void
    {
        $data = ['title' => 'Welcome'];
        $this->view('pages/index', $data);
    }

    public function about(): void
    {
        $data = ['title' => 'About Us'];
        $this->view('pages/about', $data);
    }
}