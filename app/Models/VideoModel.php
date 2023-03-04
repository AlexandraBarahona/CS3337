<?php namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model {
    protected $table = 'video';
    protected $allowedFields = ['name', 'type'];
    // protected $beforeInsert = ['beforeInsert'];
    // protected $beforeUpdate = ['beforeUpdate'];

    public function getVideo($id) {
        return $this->where('id', $id)->first();
    }

    public function saveVideo($video) {
        $this->save($video);
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

    public function getVideoQuery($query) {
        $db = db_connect();
        $result = $db->query($query);
        return $result->getResult();
    }
}
?>