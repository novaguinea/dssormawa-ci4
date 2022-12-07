<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'assessment_cat';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['category_name', 'cat_weight', 'is_active'];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getCategories()
    {
        return $this->findAll();
    }

    public function getCategoryById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function addCategory($data)
    {
        return $this->insert($data);
    }

    public function deleteCategory($id)
    {
        return $this->where(['id' => $id])->delete();
    }

}
