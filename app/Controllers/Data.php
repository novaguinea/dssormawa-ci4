<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DataOrmawaModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;

use CodeIgniter\Files\File;

class Data extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->dataOrmawaModel = new DataOrmawaModel();
        $this->categoryModel = new CategoryModel();
        $this->variableModel = new VariableModel();
        $this->criterionModel = new CriterionModel();
        $this->scoringModel = new ScoringModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Penilaian',
            'users' => $this->userModel->getUsers()
        ];

        return view('pages/data/index', $data);
    }

    public function detailOrmawa($id)
    {
        $data = [
            'title' => 'Detail Data',
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            'criterion' => $this->criterionModel->getCriterionById($id)
        ];

        return view('pages/data/data_category_user', $data);
    }

    public function detailDataCriterion($idCat)
    {
        $data = [
            'title' => 'Detail Data',
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            'criterion' => $this->criterionModel->getCriterionByCategory($idCat),
            'data' => $this->dataOrmawaModel->getAllDataByOrmawa(1)
            //$this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa)
        ];

        return view('pages/data/data_criterion_user', $data);
    }

    public function viewDetailData($idCriterion, $idData)
    {
        $dataormawa = $this->dataOrmawaModel->getDataById($idData);

        $data = [
            'title' => 'Detail Data',
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            'criterion' => $this->criterionModel->getCriterionById($idCriterion),
            'data' => $dataormawa,
            'scoring' => $this->scoringModel->getScoringById($dataormawa['scoring_id'])
            //$this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa)
        ];

        return view('pages/data/detail_data_each_scoring', $data);
    }

    public function mooraCalculation()
    {

    }

    public function normalizationAlternative()
    {
        $dataOrmawa = $this->dataOrmawaModel->getAllData();
        $criterion = $this->criterionModel->getCriterions();
        $users = $this->userModel->getUsers();

        $lenData = count($dataOrmawa);
        $lenCriterion = count($criterion);


        foreach ($criterion as $c)
        {
            for($y=0; $y=$lenData; $y++)
            {
                $score = $this->calculateScore($c['id'], $idOrmawa);

            }
        }

    /** $data = array(
         
                'criterion_id' => (
            
                    'ormawa_id_1' => (
                        'total_score' => $x
                    ),

                    'ormawa_id_2' => (
                        'total_score' => $x
                    ),

                )
        
        ) 
        **/

        $data = [
            'data' => $dataOrmawa,
            'criterion' => $criterion
        ];

        return view('pages/dump', $data);

    }

    //calculating score from each criterion filtered by ormawa_id
    public function calculateScore($idCriterion, $idOrmawa)
    {
        $dataCriterion = $this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa);
        $dataCount = 0;

        foreach($dataCriterion as $d)
        {
            if($d['criterion_id'] == $idCriterion)
            {
                $dataCount = $dataCount + $this->scoringModel->getScoringById($d['scoring_id']);
            }

        }

        return $dataCount;
    }

}
