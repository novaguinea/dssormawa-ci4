<?php

namespace App\Models;

use CodeIgniter\Model;

class ScoringModel extends Model
{
    protected $table      = 'scoring_per_criterion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_criterion', 'description', 'score', 'is_active'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getScorings()
    {
        return $this->findAll();
    }

    public function getScoringByCriterion($id)
    {
        return $this->where(['id_criterion' => $id])->findAll();
    }

    public function getScoringById($id)
    {
        return $this->where(['id' => $id])->findAll();
    }

    public function getScoringByCriterionScore($id)
    {
        return $this->where(['id_criterion' => $id])->findAll();
    }

    public function addScoring($data)
    {
        return $this->insert($data);
    }

    public function deleteScoring($id)
    {
        return $this->where(['id' => $id])->delete();
    }

}
