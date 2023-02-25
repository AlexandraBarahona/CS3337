<?php namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model {
    protected $table = 'images';
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