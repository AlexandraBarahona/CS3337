<?php namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model {
    protected $table = 'video';
    protected $allowedFields = ['id', 'name', 'type', 'path', 'caption', 
                                'updated_at', 'duration', 'note'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    protected $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function getVideo($id) {
        parent::__construct();
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
        $result = $this->db->query($query);
        return $result->getResult();
    }

    public function deleteVideo($id) {
        $this->delete($id);
    } 

    public function getVideoPath($id) {
        parent::__construct();

        $video = $this->where('id', $id)->first();
        return (isset($video)) ? $video['path'] : null;
    }

    public function searchVideos($query) {
        $query = trim($this->db->escapeString($query));

        $words = null;
        if(str_contains($query, " ")) {
            $words = explode(" ", $query);
        }

        $sqlQuery = "SELECT *, 'Video' as filetype FROM " . $this->table .
                     " WHERE name LIKE '%" . $query . "%'" ;

        if(!empty($words)) {
            foreach($words as $word) {
                if(trim($word) == '') {
                    continue;
                }
                $sqlQuery = $sqlQuery . " OR name LIKE '%". $word . "%'"; 
            }
            
        }

        $sqlQuery = $sqlQuery . ';';

        $result = $this->query($sqlQuery);

        return $result->getResult();
    }
}
?>