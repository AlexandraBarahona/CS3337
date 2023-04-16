<?php namespace App\Models;

use CodeIgniter\Model;

class AudioModel extends Model {
    protected $table = 'audio';
    protected $allowedFields = ['id', 'name', 'type', 'path', 'caption', 'updated_at', 'duration'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    protected $db;
    public function __construct() {
        $this->db = db_connect();
    }

    public function getAudio($id) {
        parent::__construct();
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
        $result = $this->db->query($query);
        return $result->getResult();
    }

    public function deleteAudio($id) {
        $this->delete($id);
    }

    public function getAudioPath($id) {
        parent::__construct();  
        
        $audio = $this->where('id', $id)->first();
        return $audio['path'];
    }

    public function searchAudios($query) {
        $query = $this->db->escapeString($query);

        $words = null;
        if(str_contains($query, " ")) {
            $words = explode(" ", $query);
        }

        $sqlQuery = "SELECT *, 'Audio' as filetype FROM " . $this->table .
                     " WHERE name LIKE '%" . $query . "%'" ;

        if(!empty($words)) {
            foreach($words as $word)
            $sqlQuery = $sqlQuery . " OR name LIKE '%". $word . "%'"; 
        }

        $sqlQuery = $sqlQuery . ';';

        $result = $this->query($sqlQuery);

        return $result->getResult();
    }
}
?>