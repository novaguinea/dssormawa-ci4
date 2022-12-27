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
        $this->session = \Config\Services::session();
    }


    public function index()
    {

        $data = [
            'title' => 'Data Kategori Penilaian',
            'category' => $this->categoryModel->getCategories(),
            'role_id' => $this->session->get('role_id')
        ];

        // dd($this->session->get());

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
        $dataWeight = $this->request->getPost("inputCriterionWeight");

        $this->criterionModel->addCriterion([
            'id_cat' => $id,
            'criterion_name' => $this->request->getPost("inputCriterion"),
            'criterion_weight' => $this->request->getPost("inputCriterionWeight"),
            'description' => $this->request->getVar("inputCriterionDescription"),
            'is_active' => 1
        ]);

        return redirect()->to("/rules/detail/$id");
        
    }

    public function saveScoringIndicator()
    {
        // dd($this->request->getVar());
        $idCriterion = $this->request->getPost("hiddenCriterionId");
        $idCategory = $this->request->getPost("hiddenCategoryId");

        $this->scoringModel->addScoring([
            'id_criterion' => $idCriterion,
            'description' => $this->request->getPost("inputIndicatorDesc"),
            'score' => $this->request->getPost("inputIndicatorScore"),
            'is_active' => 1
        ]);

        return redirect()->to("/rules/detail/criterion/$idCriterion");
    }

    public function detailCategory($id)
    {
        $data = [
            'title' => 'Detail Kategori',
            'category' => $this->categoryModel->getCategoryById($id),
            'criterion' => $this->criterionModel->getCriterionByCategory($id),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/rules/detail_category', $data);
    }

    public function detailCriterion($idCriterion)
    {
        $data = [
            'title' => 'Detail Kategori',
            'criterion' => $this->criterionModel->getCriterionById($idCriterion),
            'scoring' => $this->scoringModel->getScoringByCriterion($idCriterion),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/rules/detail_scoring', $data);
    }

    public function addCriterion($id)
    {
        $data = [
            'title' => 'Add New Criterion',
            'category' => $this->categoryModel->getCategoryById($id),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/rules/add_criterion', $data);
    }

    public function addScoringIndicator($idCriterion)
    {
        $data = [
            'title' => 'Add New Criterion',
            'criterionId' => $idCriterion,
            'role_id' => $this->session->get('role_id')
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

    public function deleteScoringIndicator($idScoring, $idCriterion)
    {
        // $idCat = $this->criterionModel->getCriterionById($id);
        // $idCat = $idCat['id_cat'];
        $this->scoringModel->deleteScoring($idScoring);

        return redirect()->to("/rules/detail/criterion/$idCriterion");
    }

    /**
     * 
     * Additional function for rules
     * 
     * 1. weighting no more than 100% for each category
     * 
     */

    public function checkCriterionWeighting($newData): bool
    {
        $data = $this->criterionModel->getCriterions();
        $data_length = count($data);

        $weight_calculated = 0;
        $isSafe = true;

        for ($i = 0; $i < $data_length; $i++) {
            $weight_calculated = $weight_calculated + $data[$i]['criterion_weight'];
        }

        if(($weight_calculated + $newData) > 100)
        {
            $isSafe = false;
        }

        return $isSafe;
    }


  

}
