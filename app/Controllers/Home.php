<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data =[];

        echo view('templates/header', $data);
        echo view('welcome_message');
        echo view('templates/footer');
    }
}
