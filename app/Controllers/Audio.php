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
        // The upload helper is a custom helper that can be found in the helpers folder
        helper(['form', 'url', 'upload', 'date']);

        $file = $this->request->getFile('file');
        $targetPath = ROOTPATH . 'public/audio/';

        if($file->isValid() && !$file->hasMoved()) {
            $targetFile = $targetPath . $file->getName();
            $newName = rename_audio(pathinfo($targetFile));
            $file->move($targetPath, $newName);
            $model = new AudioModel();
            
            $durationInSeconds = $this->request->getVar('fileDuration');
            $time = get_time_from_seconds($durationInSeconds);
            $duration = sprintf('%02d:%02d:%02d', $time['hours'], $time['minutes'], $time['seconds']);

            $audioData = [
                'name' => $file->getName(),
                'type' => $file->getClientMimeType(),
                'path' => $targetPath . $newName,
                'caption' => $file->getName(),
                'updated_at' => date('Y-m-d H:i:s', now()),
                'duration' => $duration,
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
                'note' => $this->request->getPost('note'),
            ];

            $model->saveAudio($audData);
            
            return redirect()->to(previous_url());
        }
    }


    public function delete($id) {
        helper(['form', 'url', 'upload']);
        $model = new AudioModel();

        $path = $model->getAudioPath($id);
        
        unlink($path);
        $model->deleteAudio($id);

        return redirect()->to(previous_url());
    }
}
