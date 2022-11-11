<?php

/**
 * 
 * this controller uses for configurating assessment rules (kriteria penilaian)
 * 
 * note:
 * 1. category -> This would be an assessment category which means what kind of assessment that 
 * we want to assess. This also separated the administrative category from achievement and collaboration 
 * assessment.
 * 
 * 2. variable -> Only used by administrative category for dividing each “administrative category”.
 * 
 * 3. criterion -> Baseline for other categories beside administrative category (administrative category 
 * too actually).
 * 
 * 4. scoring -> Filled with scoring indicators to know how it is going to be scored. 
 * 
 * **/ 


namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;

class Rules extends BaseController
{

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->variableModel = new VariableModel();
        $this->criterionModel = new CriterionModel();
        $this->scoringModel = new ScoringModel();
    }


    public function index()
    {

        $data = [
            'title' => 'Data Kategori Penilaian',
            'category' => $this->categoryModel->getCategories()
        ];

        return view('pages/rules/index', $data);
    }

    public function addCategory()
    {
        // dd($this->request->getVar());
        $this->categoryModel->addCategory([
            'category_name' => $this->request->getPost("inputCategory"),
            'is_active' => 1
        ]);

        return redirect()->to('/rules');
    }

    public function saveCriterion()
    {
        // dd($this->request->getVar());
        $id = $this->request->getPost("hiddenCategoryId");

        $this->criterionModel->addCriterion([
            'id_cat' => $id,
            'criterion_name' => $this->request->getPost("inputCriterion"),
            'criterion_weight' => $this->request->getPost("inputCriterionWeight"),
            'is_active' => 1
        ]);

        return redirect()->to("/rules/detail/$id");
    }

    public function detailCategory($id)
    {
        $data = [
            'title' => 'Detail Kategori',
            'category' => $this->categoryModel->getCategoryById($id),
            'criterion' => $this->criterionModel->getCriterionByCategory($id)
        ];

        return view('pages/rules/detail_category', $data);
    }

    public function detailCriterion($idCategory, $idCriterion)
    {
        $data = [
            'title' => 'Detail Kategori',
            'criterion' => $this->criterionModel->getCriterionById($idCriterion),
            'scoring' => $this->scoringModel->getScoringByCriterion($idCategory)
        ];

        return view('pages/rules/detail_scoring', $data);
    }

    public function addCriterion($id)
    {
        $data = [
            'title' => 'Add New Criterion',
            'category' => $this->categoryModel->getCategoryById($id)
        ];

        return view('pages/rules/add_criterion', $data);
    }

    public function addScoringIndicator($id)
    {
        $data = [
            'title' => 'Add New Criterion',
            'criterion' => $this->criterionModel->getCriterionById($id)
        ];

        return view('pages/rules/add_scoring', $data);
    }

    public function deleteCategory($id)
    {
        $this->categoryModel->deleteCategory($id);

        return redirect()->to("/rules");
    }

    public function deleteCriterion($id)
    {
        $idCat = $this->criterionModel->getCriterionById($id);
        $idCat = $idCat['id_cat'];
        $this->criterionModel->deleteCriterion($id);

        return redirect()->to("/rules/detail/$idCat");
    }

    public function deleteScoringIndicator($idCategory, $idCriterion)
    {
        // $idCat = $this->criterionModel->getCriterionById($id);
        // $idCat = $idCat['id_cat'];
        // $this->criterionModel->deleteCriterion($id);

        // return redirect()->to("/rules/detail/$idCat");
    }

}
