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
        $data['showNavbar'] = true;
        $files['audio'] = $model->getAllByName();
        echo view('templates/header', $data);
        echo view('content/audio', $files);
        echo view('templates/footer');
    }



    public function audioUpload()
    {
        // Set upload configuration
        helper(['form', 'url', 'upload', 'date']);

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = ROOTPATH . 'public/audio/';
            $targetFile = $targetPath . rename_audio(pathinfo($_FILES['file']['name']));

            move_uploaded_file($tempFile, $targetFile);

            $model = new AudioModel();
            $file = pathinfo($targetFile);

            $audioData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
                'path' => $targetFile,
                'caption' => $file['basename'],
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveAudio($audioData);
        }
    }

    public function edit() {
        if($this->request->getMethod() == 'post') {
            helper(['form', 'date']);
            $model = new AudioModel();
            
            $audData = [
                'id' => $this->request->getPost('id'),
                'name' => $this->request->getPost('name'),
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveAudio($audData);
            
            return redirect()->to('/audioPage');
        }
    }

    public function delete() {
        helper(['form', 'url', 'upload']);
        $model = new AudioModel();

        $id = $this->request->getVar('id');
        $path = $model->getAudioPath($id);
        
        unlink($path);
        $model->deleteAudio($id);

        return redirect()->to('/audioPage');
    }
}
