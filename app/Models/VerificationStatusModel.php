<?php

namespace App\Models;

use CodeIgniter\Model;

class VerificationStatusModel extends Model
{
    protected $table      = 'verification_data';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'access'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getPembinaData()
    {
        return $this->where(['access !=' => 1])->findAll();
    }

    public function updateVerification($id, $data)
    {
        return $this->update($id, $data);
    }
}
