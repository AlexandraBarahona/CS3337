<?php namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model {
    protected $table = 'images';
    protected $allowedFields = ['name', 'type'];
    //protected $beforeInsert = ['beforeInsert'];
    //protected $beforeUpdate = ['beforeUpdate'];

    public function __construct() {
        $this->db = db_connect();
        
    }

    public function getImage($id) {
        return $this->where('id', $id)->first();
    }

    public function saveImage($image) {
        $this->save($image);
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

    public function getImageQuery($query) {
        $db = db_connect();
        $result = $db->query($query);
        return $result->getResult();
    }
 }
?>