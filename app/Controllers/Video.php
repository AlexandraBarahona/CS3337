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
        $data['showNavbar'] = true;
        $files['video'] = $model->getAllByName();
        echo view('templates/header', $data);
        echo view('content/video', $files);
        echo view('templates/footer');
    }



    public function videoUpload()
    {
        // The upload helper is a custom helper that can be found in the helpers folder
        helper(['form', 'url', 'upload', 'date']);

        $file = $this->request->getFile('file');
        $targetPath = ROOTPATH . 'public/video/';

        if (!empty($_FILES)) {
            $targetFile = $targetPath . $file->getName();
            $newName = rename_video(pathinfo($targetFile));
            $file->move($targetPath, $newName);
            $model = new VideoModel();

            $durationInSeconds = $this->request->getVar('fileDuration');
            $time = get_time_from_seconds($durationInSeconds);
            $duration = sprintf('%02d:%02d:%02d', $time['hours'], $time['minutes'], $time['seconds']);

            $videoData = [
                'name' => $file->getName(),
                'type' => $file->getClientMimeType(),
                'path' => $targetPath . $newName,
                'caption' => $file->getName(),
                'updated_at' => date('Y-m-d H:i:s', now()),
                'duration' => $duration,
            ];

            $model->saveVideo($videoData);
        }
    }

    public function videoDownload() {
        $model = new VideoModel();
        $id = $this->request->getVar('id');
        $path = $model->getVideoPath($id);

        return $this->response->download($path, null);
    }

    public function edit() {
        if($this->request->getMethod() == 'post') {
            helper(['form', 'date']);
            $model = new VideoModel();
            
            $vidData = [
                'id' => $this->request->getPost('id'),
                'name' => $this->request->getPost('name'),
                'updated_at' => date('Y-m-d H:i:s', now()),
            ];

            $model->saveVideo($vidData);
            
            return redirect()->to('/video');
        }
    }

    public function delete() {
        helper(['form', 'url', 'upload']);
        $model = new VideoModel();

        $id = $this->request->getVar('id');
        $path = $model->getVideoPath($id);

        unlink($path);
        $model->deleteVideo($id);

        return redirect()->to('/video');
    }

}
