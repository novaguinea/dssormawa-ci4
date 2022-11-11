<?php

namespace App\Models;

use CodeIgniter\Model;

class DataOrmawaModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['username', 'nama', 'password', 'logo', 'role_id', 'ormawa_id'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    

    
}
