<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\ImageModel;

class Image extends BaseController
{
    public function __construct() {
    
    }

    public function index()
    {
        $model = new ImageModel();
        $data = [];
        $data['title'] = 'Images';
        $data['showNavbar'] = true; // Added by Dylan Tomasello
        $files['images'] = $model->getAllByName() ;
        echo view('templates/header', $data);
        echo view('content/image', $files);
        echo view('templates/footer');
    }



    public function imageUpload()
    {
        // Set upload configuration
        helper(['form', 'url']);
        $data = [];

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/images/';
            $targetFile = $targetPath . $_FILES['file']['name'];

            move_uploaded_file($tempFile, $targetFile);

            $model = new ImageModel();

            $imgData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
            ];

            $model->saveImage($imgData);

            $files['images'] = $model->getAllByName();
            
        }
  
    }
}
