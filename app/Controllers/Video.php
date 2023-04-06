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

        $file = $this->request->getFile('file');
        $targetPath = ROOTPATH . 'public/video/';

        if (!empty($_FILES)) {
            $targetFile = $targetPath . $file->getName();
            $newName = rename_video(pathinfo($targetFile));
            $file->move($targetPath, $newName);
            $model = new VideoModel();


            $videoData = [
                'name' => $file->getName(),
                'type' => $file->getClientMimeType(),
                'path' => $targetPath . $newName,
                'caption' => $file->getName(),
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
