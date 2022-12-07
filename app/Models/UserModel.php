<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['username', 'nama', 'password', 'logo', 'role_id', 'is_ormawa'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function getUsers()
    {
        return $this->findAll();
    }

    public function getAllOrmawaUsers()
    {
        return $this->where(['is_ormawa' => 1])->findAll();
    }
    
    public function getUserById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function deleteUser($id)
    {
        return $this->where(['id' => $id])->delete();
    }

    public function updateUser($id, $data)
    {
        return $this->where(['id' => $id])->update($data);
    }
    
}

?>
