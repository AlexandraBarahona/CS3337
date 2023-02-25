<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\VideoModel;

class Video extends BaseController
{
    public function __construct() {
        
    }

    public function index()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM video ORDER BY name;');
        $data = [];
        $data['title'] = 'Video';

        $files['video'] = $query->getResult();
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
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/video/';
            $targetFile = $targetPath . $_FILES['file']['name'];

            move_uploaded_file($tempFile, $targetFile);

            $model = new VideoModel();

            $videoData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
            ];

            $model->save($videoData);
        }
  
    }
}
