<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\ImageModel;

class Image extends BaseController
{

    public function index()
    {
        $model = new ImageModel();
        $data = [];
        $data['title'] = 'Images';
        $data['showNavbar'] = true;
        $files['images'] = $model->getAllByName() ;
        echo view('templates/header', $data);
        echo view('content/image', $files);
        echo view('templates/footer');
    }



    public function imageUpload()
    {
        // Set upload configuration
        helper(['form', 'url', 'upload', 'date']);
        $data = [];

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = ROOTPATH . 'public/images/'; 
            $targetFile = $targetPath . rename_image(pathinfo($_FILES['file']['name'])); 

            move_uploaded_file($tempFile, $targetFile);

            $model = new ImageModel();
            $file = pathinfo($targetFile);


            $imgData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
                'path' => $targetFile,
                'caption' => $file['basename'],
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveImage($imgData);
            
        }
    }

    public function imageDownload() {
        $model = new ImageModel();
        $id = $this->request->getVar('id');
        $path = $model->getImagePath($id);

        return $this->response->download($path, null);
    }

    public function edit() {
        if($this->request->getMethod() == 'post') {
            helper(['form', 'date']);
            $model = new ImageModel();
            
            $imgData = [
                'id' => $this->request->getPost('id'),
                'name' => $this->request->getPost('name'),
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveImage($imgData);
            
            return redirect()->to('/image');
        }
    }

    public function delete() {
        helper(['form', 'url', 'upload']);
        $model = new ImageModel();

        $id = $this->request->getVar('id');
        $path = $model->getImagePath($id);
        
        unlink($path);
        $model->deleteImage($id);

        return redirect()->to('/image');
    }
}
