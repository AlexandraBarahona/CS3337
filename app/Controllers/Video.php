<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\VideoModel;

class Video extends BaseController
{
    public function index()
    {
        $model = new VideoModel();
        $data = [];
        $data['title'] = 'Video';

        $files['video'] = $model->getVideoQuery('SELECT * FROM video ORDER BY name;');
        echo view('templates/header', $data);
        echo view('content/video', $files);
        echo view('templates/footer');
    }



    public function videoUpload()
    {
        // Set upload configuration
        helper(['form', 'url']);
        $data = [];

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/public/video/';
            $targetFile = $targetPath . $_FILES['file']['name'];

            move_uploaded_file($tempFile, $targetFile);

            $model = new VideoModel();

            $videoData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
            ];

            $model->saveVideo($videoData);
        }
  
    }
}
