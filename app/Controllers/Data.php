<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DataOrmawaModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;
use App\Models\VerificationStatusModel;

use CodeIgniter\Files\File;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

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
        $this->verificationStatusModel = new VerificationStatusModel();
    }

    public function index()
    {
        $do = $this->finalCalculation();
        arsort($do);

        $data = [
            'title' => 'Kategori Penilaian',
            'users' => $this->userModel->getAllOrmawaUsers(),
            'dataormawa' => $do
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
            'status' => $this->verificationStatusModel->getAllData(),
            'data' => $this->dataOrmawaModel->getAllDataByOrmawa(1)
            //$this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa)
        ];

        return view('pages/data/data_criterion_user', $data);
    }

    public function updateStatus()
    {
        $id = $this->request->getPost('idForDataOrmawaStatus');
        $allData = $this->dataOrmawaModel->getDataById($id);
        
        $data = [
            'id' => $this->request->getPost('idForDataOrmawaStatus'),
            'id_is_verified' => $this->request->getPost('dataOrmawaStatus'),
            'criterion' => $this->criterionModel->getCriterionById($allData['criterion_id']),
            'data' => $allData
        ];
        // dd($data);
        //idForDataOrmawaStatus
        $this->dataOrmawaModel->updateVerification($data);
        // dd($x)
        return redirect()->to('data/detail/' . $allData['criterion_id'] . '/' . $id);
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
            'status' => $this->verificationStatusModel->getAllData(),
            'scoring' => $this->scoringModel->getScoringById($dataormawa['score'])
            //$this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa)
        ];

        return view('pages/data/detail_data_each_scoring', $data);
    }

    public function finalCalculation()
    {
        /**
         * 
         * IMPORTANT!
         * If you want to show the final result, just call this function
         * 
         * This function calls all function of MOORA Calculation
         * 
         * DISCLAIMER:
         * this ranking terms is in weighted conditions WILL BE CHANGED due time by time regulations
         * 
         * Note:
         * 
         * data from mooraCalculation will return value as shown below
         * 
         * $data = [
         *     category_id => [
         *         criterion_id => [
         *             ormawa_id => value
         *         ]
         *     ]
         * ];
         * 
         * Flow:
         * 1. Get data each ormawa's criterion and category (v)
         * 2. Multiple with the weight for each category (v)
         * 3. Calculate all the value from each category (v)
         * 4. Sort the data by ormawa (v)
         * 
         * 
         * The return value will be like this: (and it's sorted!)
         * 
         * $data = [
         *     ormawa_id => all calculated value
         * ]
         * 
         */

         $ormawaCalculatedData = array();
         $temp = array();
         $data = $this->mooraCalculation();

         $ormawaData = $this->userModel->getAllOrmawaUsers();

         foreach($ormawaData as $od)
         {
            foreach($data as $dc => $dc_value)
            {
                // var_dump($dc);
                foreach($dc_value as $valueCri)
                {
                    foreach($valueCri as $d => $d_value)
                    {
                        if($d == $od['id'])
                        {
                            if(isset($temp))
                            {
                                $temp += [$dc => $d_value];
                            } else {
                                $temp = [$dc => $d_value];
                            }
                        }
                    } 

                    // dd($temp);

                    $category = $this->categoryModel->getCategoryById($dc);
                    // var_dump($temp);
                    if($temp[$dc] != null)
                    {
                        $temp[$dc] = $temp[$dc] * $category['cat_weight'];
                    }
                    // dd($od);
                    $ormawaCalculatedData += [$od['nama'] => $temp[$dc]];
                    // var_dump($temp);
                    $temp = null;
                }
            }
         }

        // dd($ormawaCalculatedData);
        
        return $ormawaCalculatedData;
    }

    public function dump()
    {
        $data = $this->mooraCalculation();
        $rank = $this->finalCalculation($data);
    }


    public function mooraCalculation()
    {
        $category = $this->categoryModel->getCategories();
        $newMatrix = (array) null;
        $data = (array) null;
        $x = 0;
        
        foreach($category as $c)
        {      
            // dd($c);
            $criteria = $this->criterionModel->getCriterionByCategory($c['id']);
            // var_dump($c['id']);
            $matrix = $this->inputMatrix($c['id']);
            // var_dump($matrix);
            foreach($matrix as $m => $m_value)
            {
                // var_dump($matrix);
                $newMatrix[$m] = $this->normalizationPerCriteria($matrix[$m], $criteria[$x]['criterion_weight']); // get value per criteria
                $x++;
            }    

            $x = 0;
            
            $data[$c['id']] = $newMatrix;
            $newMatrix = (array) null;
            // var_dump($data);
        }

        foreach($category as $c)
        {      
            // dd($c);
            $criteria = $this->criterionModel->getCriterionByCategory($c['id']);
            // var_dump($c['id']);
            $matrix = $this->inputMatrix($c['id']);
            // var_dump($matrix);
            foreach($matrix as $m => $m_value)
            {
                // var_dump($matrix);
                $newMatrix[$m] = $this->normalizationPerCriteria($matrix[$m], $criteria[$x]['criterion_weight']); // get value per criteria
                $x++;
            }    

            $x = 0;
            
            $data[$c['id']] = $newMatrix;
            $newMatrix = (array) null;
            // var_dump($data);
        }

        return $data;
    }

    public function inputMatrix($idCat)
    {
        $x=1;
        $data = (array) null;
        $matrix = (array) null;

        $criterion = $this->criterionModel->getCriterionByCategory($idCat);

        $users = $this->userModel->getAllOrmawaUsers();

        foreach ($criterion as $c)
        {  
            foreach($users as $u)
            {
                $score = $this->calculateScore($c['id'], $u['id']);
                $data += [$u['id'] => $score];
                $x++;                                   
            }
            // dd($data);
            $matrix+=[($c['id']) => $data];
            // var_dump($matrix);
            $x=1;

            $data = (array) null;
        }

        return $matrix;

    }

    //calculating score from each criterion filtered by ormawa_id
    public function calculateScore($idCriterion, $idOrmawa) : int
    {
        $dataCriterion = $this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa);
        $dataCount = 0;

        foreach($dataCriterion as $d)
        {
            if($d['criterion_id'] == $idCriterion)
            {
                $dataCount = $dataCount +  (int)($d['score']);
            }
        }        

        return (int)$dataCount;
    }

    public function normalizationPerCriteria(array $dataPerCriteria, $weight)
    {
        $divider = 0;
        $newMatrix = (array) null;

        //count for the divider
        foreach($dataPerCriteria as $d => $d_value)
        {
            $divider+= pow($d_value, 2);
        }

        $divider = sqrt($divider);

        foreach($dataPerCriteria as $d => $d_value)
        {
            $result = $d_value/$divider*$weight;
            $newMatrix += [$d => $result];
        }
        // dd($newMatrix);

        return $newMatrix;

    }

}
