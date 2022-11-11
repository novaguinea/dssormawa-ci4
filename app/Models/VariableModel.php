<?php

namespace App\Models;

use CodeIgniter\Model;

class VariableModel extends Model
{
    protected $table      = 'variable_per_cat';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_cat', 'variable_name', 'is_active'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getVariables()
    {
        return $this->findAll();
    }

    public function getVariableById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function addVariable($data)
    {
        return $this->insert($data);
    }

    public function deleteVariable($id)
    {
        return $this->where(['id' => $id])->delete();
    }

}
