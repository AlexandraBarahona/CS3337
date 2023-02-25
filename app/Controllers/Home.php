<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM images ORDER BY uploaded_at DESC limit 10;');
        $data['title'] = 'Home';
        $data['type'] = 'image';
        $data['files'] = $query->getResult();
        echo view('templates/header', $data);
        echo view('content/home', $data);
        echo view('templates/footer');
    }

    public function getAudioInfo() {
        $db = db_connect();
        $query = $db->query('SELECT * FROM audio ORDER BY uploaded_at DESC limit 10;');
        $data['title'] = 'Home';
        $data['type'] = 'audio';
        $data['files'] = $query->getResult();
        echo view('templates/header', $data);
        echo view('content/home', $data);
        echo view('templates/footer');
    } 

    public function getVideoInfo() {
        $db = db_connect();
        $query = $db->query('SELECT * FROM video ORDER BY uploaded_at DESC limit 10;');
        $data['title'] = 'Home';
        $data['type'] = 'video';
        $data['files'] = $query->getResult();
        echo view('templates/header', $data);
        echo view('content/home', $data);
        echo view('templates/footer');
    } 
}
