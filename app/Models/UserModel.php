<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        if(isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // protected function beforeUpdate(array $data) {
        
    //     return $data;
    // }
}
?>