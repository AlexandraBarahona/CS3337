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

        $file = $this->request->getFile('file');
        $targetPath = ROOTPATH . 'public/audio/';

        if($file->isValid() && !$file->hasMoved()) {
            $targetFile = $targetPath . $file->getName();
            $newName = rename_audio(pathinfo($targetFile));
            $file->move($targetPath, $newName);
            $model = new AudioModel();
            

            $audioData = [
                'name' => $file->getName(),
                'type' => $file->getClientMimeType(),
                'path' => $targetPath . $newName,
                'caption' => $file->getName(),
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveAudio($audioData);
        }
    }

    public function audioDownload() {
        $model = new AudioModel();
        $id = $this->request->getVar('id');
        $path = $model->getAudioPath($id);

        return $this->response->download($path, null);
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
            
            return redirect()->to('/audio');
        }
    }


    public function delete() {
        helper(['form', 'url', 'upload']);
        $model = new AudioModel();

        $id = $this->request->getVar('id');
        $path = $model->getAudioPath($id);
        
        unlink($path);
        $model->deleteAudio($id);

        return redirect()->to('/audio');
    }
}
