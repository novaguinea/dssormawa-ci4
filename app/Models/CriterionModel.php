<?php

namespace App\Models;

use CodeIgniter\Model;

class CriterionModel extends Model
{
    protected $table      = 'criterion_per_var';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_var', 'id_cat', 'criterion_name', 'criterion_weight', 'description', 'is_active'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getCriterions()
    {
        return $this->findAll();
    }

    public function getCriterionByCategory($id) //getting all criterions filter by category
    {
        return $this->where(['id_cat' => $id])->findAll();
    }

    public function getCriterionById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function addCriterion($data)
    {
        return $this->insert($data);
    }

    public function deleteCriterion($id)
    {
        return $this->where(['id' => $id])->delete();
    }
}
