<?php namespace App\Models;

use CodeIgniter\Model;

class AudioModel extends Model {
    protected $table = 'audio';
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