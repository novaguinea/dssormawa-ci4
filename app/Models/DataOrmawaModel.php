<?php

namespace App\Models;

use CodeIgniter\Model;
// use App\Models\UserModel;

class DataOrmawaModel extends Model
{
    protected $table      = 'data_ormawa_per_criterion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['ormawa_id', 'criterion_id', 'title', 'description', 'score', 'file'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getAllDataByOrmawa($id)
    {
        return $this->where(['ormawa_id' => $id])->findAll();
    }

    public function getDataByCriterion($idCriterion)
    {
        /**
         * getting all criterions filter by criterion
         * [LATER will be] filtered by ORMAWA ID
         */
        // return $this->where(['criterion_id' => $idCriterion])->where(['ormawa_id' => $idOrmawa])->findAll();
        return $this->where(['criterion_id' => $idCriterion])->findAll();
    }

    public function getDataCriterionAndOrmawa($idCriterion, $idOrmawa)
    {
        return $this->where(['ormawa_id' => $idOrmawa])->where(['criterion_id' => $idCriterion])->findAll();
    }

    public function getDataById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function addData($data)
    {
        return $this->insert($data);
    }

    public function deleteData($id)
    {
        return $this->where(['id' => $id])->delete();
    }
    
}
