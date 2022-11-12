<?php

namespace App\Models;

use CodeIgniter\Model;

class DataOrmawaModel extends Model
{
    protected $table      = 'data_ormawa_per_criterion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['ormawa_id', 'criterion_id', 'title', 'description', 'scoring_indicator', 'file'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getDataByCriterion($idCriterion) //getting all criterions filter by criterion
    {
        return $this->where(['criterion_id' => $idCriterion])->findAll();
    }

    public function getDataById($id)
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
