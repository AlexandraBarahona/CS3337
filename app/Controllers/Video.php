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
        // Set upload configuration
        helper(['form', 'url', 'upload', 'date']);
        $data = [];

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = ROOTPATH . 'public/video/';
            $targetFile = $targetPath . rename_video(pathinfo($_FILES['file']['name']));

            move_uploaded_file($tempFile, $targetFile);

            $model = new VideoModel();
            $file = pathinfo($targetFile);

            $videoData = [
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
                'path' => $targetFile,
                'caption' => $file['basename'],
                'updated_at' => date('Y-m-d H:i:s', now()),
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
            
            return redirect()->to('/videoPage');
        }
    }

    public function delete() {
        helper(['form', 'url', 'upload']);
        $model = new VideoModel();

        $id = $this->request->getVar('id');
        $path = $model->getVideoPath($id);

        unlink($path);
        $model->deleteVideo($id);

        return redirect()->to('/videoPage');
    }

}
