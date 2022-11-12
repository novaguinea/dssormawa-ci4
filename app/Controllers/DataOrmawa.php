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

    public function listOfCategory()
    {

        $data = [
            'title' => 'Kategori Penilaian',
            'category' => $this->categoryModel->getCategories()
        ];

        return view('pages/dataormawa/index', $data);
    }

    public function detailCategory($id)
    {
        $data = [   
            'title' => 'Kategori Penilaian',
            'category' => $this->categoryModel->getCategoryById($id),
            'criterion' => $this->criterionModel->getCriterionByCategory($id)
        ];

        return view('pages/dataormawa/data_criterion', $data);
    }

    public function detailCriterion($id)
    {
        $data = [
            'title' => 'Kategori Penilaian',
            'criterion' => $this->criterionModel->getCriterionById($id),
            'data_nilai' =>
        ];

        return view('pages/dataormawa/input_data', $data);
    }
    
}
