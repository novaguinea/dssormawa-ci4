<?php

namespace App\Controllers;

use App\Models\DataOrmawaModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;

class DataOrmawa extends BaseController
{

    public function __construct()
    {
        $this->userModel = new DataOrmawaModel();
        $this->categoryModel = new CategoryModel();
        $this->variableModel = new VariableModel();
        $this->criterionModel = new CriterionModel();
        $this->scoringModel = new ScoringModel();
    }

    public function detailCategory()
    {

        $data = [
            'title' => 'Kategori Penilaian',
            'category' => $this->categoryModel->getCategories()
        ];

        return view('pages/dataormawa/index', $data);
    }

    public function detailCriterion()
    {

        $data = [
            'title' => 'Kategori Penilaian',
            'category' => $this->categoryModel->getCategories()
        ];

        return view('pages/dataormawa/index', $data);
    }

    
}
