<?php

class Pages extends Controller
{
    public function index()
    {
        $this->view('hello');
    }

    public function about($id)
    {
        echo $id;
    }
}