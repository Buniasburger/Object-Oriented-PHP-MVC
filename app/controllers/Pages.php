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
        $this->view('pages/about');
    }
}