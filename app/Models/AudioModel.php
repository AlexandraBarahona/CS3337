<?php namespace App\Models;

use CodeIgniter\Model;

class AudioModel extends Model {
    protected $table = 'audio';
    protected $allowedFields = ['name', 'type'];
    // protected $beforeInsert = ['beforeInsert'];
    // protected $beforeUpdate = ['beforeUpdate'];

    public function getAudio($id) {
        return $this->where('id', $id)->first();
    }

    public function saveAudio($audio) {
        $this->save($audio);
    }

    public function getLastTenUpdated() {
        $builder = $this->db->table($this->table)->orderBy('uploaded_at','DESC')->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAllByName() {
        $builder = $this->db->table($this->table)->orderBy('name', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAudioQuery($query) {
        $db = db_connect();
        $result = $db->query($query);
        return $result->getResult();
    }
}
?>