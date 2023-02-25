<?php namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model {
    protected $table = 'video';
    protected $allowedFields = ['name', 'type'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        return $data;
    }

    protected function beforeUpdate(array $data) {
        return $data;
    }
}
?>