<?php

namespace App\Controllers;
use App\Models\ImageModel;
use App\Models\AudioModel;
use App\Models\VideoModel;

class Search extends BaseController
{
    public function index()
    {
        $imgModel = new ImageModel();
        $audModel = new AudioModel();
        $vidModel = new VideoModel();

        $query = $this->request->getVar('query');

        $data['title'] = 'Search Results';
        $data['showNavbar'] = true; // Added by Dylan Tomasello
        $data['query'] = $query;
        $images = $imgModel->searchImages($query);
        $audios = $audModel->searchAudios($query);
        $videos = $vidModel->searchVideos($query);
        $data['files'] = array_merge($images, $audios, $videos);
        echo view('templates/header', $data);
        echo view('content/search', $data);
        echo view('templates/footer');
    }
}
