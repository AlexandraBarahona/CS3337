<?php

namespace App\Controllers;
use App\Models\ImageModel;
use App\Models\AudioModel;
use App\Models\VideoModel;

class Home extends BaseController
{
    public function index()
    {
        $imgModel = new ImageModel();
        $audModel = new AudioModel();
        $vidModel = new VideoModel();
        $data['title'] = 'Home';
        $data['showNavbar'] = true; // Added by Dylan Tomasello
        $data['images'] = $imgModel->getLastTenUpdated();
        $data['audio'] = $audModel->getLastTenUpdated();
        $data['videos'] = $vidModel->getLastTenUpdated();
        echo view('templates/header', $data);
        echo view('content/home', $data);
        echo view('templates/footer');
    }
}
