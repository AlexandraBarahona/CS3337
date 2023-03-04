<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\AudioModel;

class Audio extends BaseController
{
    public function __construct() {
        
    }

    public function index()
    {
        $model = new AudioModel();
        $data = [];
        $data['title'] = 'Audio';

        $files['audio'] = $model->getAllByName();
        echo view('templates/header', $data);
        echo view('content/audio', $files);
        echo view('templates/footer');
    }



    public function audioUpload()
    {
        // Set upload configuration
        helper(['form', 'url']);

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/audio/';
            $targetFile = $targetPath . $_FILES['file']['name'];

            move_uploaded_file($tempFile, $targetFile);

            $model = new AudioModel();

            $audioData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
            ];

            $model->saveAudio($audioData);
        }
  
    }
}
