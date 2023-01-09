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
use PhpParser\Node\Expr\FuncCall;

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

        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $do = $this->finalResult();
        arsort($do);

        $data = [
            'title' => 'Kategori Penilaian',
            'users' => $this->userModel->getAllOrmawaUsers(),
            'dataormawa' => $do,
            'ormawa_id' => $this->session->get('id'),
            // 'ormawa_related' => $this->session->get('ormawa_related'),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/data/index', $data);
    }

    public function indexPembina()
    {
        $do = $this->finalResult();
        arsort($do);

        $getOrmawaPembina = $this->userModel->getUserById($this->session->get('ormawa_related'));
        $data = [
            'title' => 'Data',
            'users' => $this->userModel->getUsers(),
            'ormawa_id' => $this->session->get('id'),
            'ormawa_related' => $getOrmawaPembina,
            'dataormawa' => $do,
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/data/index_pembina', $data);
    }

    public function detailOrmawa($id)
    {
        $data = [
            'title' => 'Detail Data',
            'id_ormawa' => $id,
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            // 'criterion' => $this->criterionModel->getCriterionById($id),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/data/data_category_user', $data);
    }

    public function detailDataCriterion($idOrmawa, $idCat)
    {
        $data = [
            'title' => 'Detail Data',
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            'criterion' => $this->criterionModel->getCriterionByCategory($idCat),
            'status' => $this->verificationStatusModel->getAllData(),
            'data' => $this->dataOrmawaModel->getAllDataByOrmawa($idOrmawa),
            'role_id' => $this->session->get('role_id')
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

        $verificationStatus = (array) null;
        $roleId = $this->session->get('role_id');

        if($roleId == 4)
        {
            $verificationStatus = $this->verificationStatusModel->getPembinaData();
        } else {
            $verificationStatus = $this->verificationStatusModel->getJuriData();
        }
        

        $data = [
            'title' => 'Detail Data',
            'users' => $this->userModel->getUsers(),
            'category' => $this->categoryModel->getCategories(),
            'criterion' => $this->criterionModel->getCriterionById($idCriterion),
            'data' => $dataormawa,
            'status' => $verificationStatus,
            'scoring' => $this->scoringModel->getScoringById($dataormawa['score']),
            'role_id' => $roleId
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
        $coba = $this->request->getPost("editordata");
        $data = [
            'title' => 'dump',
            'coba' => $coba
        ];
        
        return view('pages/dump', $data);
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
            // dd($matrix);
            foreach($matrix as $m => $m_value)
            {
                // var_dump($matrix);
                $newMatrix[$m] = $this->normalizationPerCriteria($matrix[$m], $criteria[$x]['criterion_weight']); // get value per criteria
                $x++;
            }    

            $x = 0;
            
            $data[$c['id']] = $newMatrix;
            $newMatrix = (array) null;
            // dd($data);
        }

        return $data;
    }

    public function inputMatrix($idCat)
    {
        $x=1;
        $data = (array) null;
        $matrix = (array) null;

        $criterion = $this->criterionModel->getCriterionByCategory($idCat); //get all criterion?

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
    public function calculateScore($idCriterion, $idOrmawa) : float
    {
        $dataCriterion = $this->dataOrmawaModel->getDataOrmawaByStatus($idOrmawa);
        $dataCount = 0;

        foreach($dataCriterion as $d)
        {
            if($d['criterion_id'] == $idCriterion)
            {
                $dataCount = $dataCount +  (float)($d['score']);
            }
        }        

        return (float)$dataCount;
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
            if($weight == 0 || $divider == 0)
            {
                $result = $d_value/1;
            }
            else 
            {
                $result = $d_value / $weight;
            }
            $newMatrix += [$d => $result];
        }
        // dd($newMatrix);

        return $newMatrix;

    }

    // ------------- NEW --------------------- //

    public function inputMat()
    {
        $x = 1;
        $data = (array) null;
        $matrix = (array) null;

        $criterion = $this->criterionModel->getCriterions();

        $users = $this->userModel->getAllOrmawaUsers();

        foreach ($criterion as $c) {
            foreach ($users as $u) {
                $score = $this->calculateScore($c['id'], $u['id']);
                $data += [$u['id'] => $score];
                $x++;
            }
            // dd($data);
            $matrix += [($c['id']) => $data];
            // var_dump($matrix);
            $x = 1;

            $data = (array) null;
        }

        // dd($matrix);

        $hehe = [
            'data' => $matrix
        ];

        // dd($matrix);
        return $matrix;

        // return view('/pages/dump', $hehe);

    }

    public function doNormalization()
    {
        $data = $this->inputMat();
        $newData = (array) null;
        // dd($data);
        $criterion = $this->criterionModel->getCriterions();
        $newMatrix = (array) null;

        $divider = 0;

        foreach($data as $datas => $data_value)
        {
            foreach($data_value as $user_id => $user_value)
            {
                $divider += pow((float)$user_value, 2);
            }

            $divider = sqrt($divider);

            foreach ($data_value as $user_id => $user_value) {

                if($divider==0)
                {
                    $value = $user_value/1;
                } else {
                    $value = $user_value / $divider;
                }

                if(!isset($newData))
                {
                    $newData = [$user_id => $value]; // buat buletin  round(, 4)
                } else {
                    $newData += [$user_id => $value];
                }

                $value = 0;
            }

            $newMatrix += [$datas => $newData];

            $newData = null;
        }
        // dd($newMatrix);

        return $newMatrix;
    }

    public function finalResult()
    {
        $ormawa = $this->userModel->getAllOrmawaUsers();
        $data = $this->doNormalization();
        $newData = (array) null;

        /**
         * 
         * 
         * $data = [
         *      $kriteria_id => [
            *      $user_id => value,
            *      $user2 => value
         * ],
         * $kriteria_id2 = [
         *      $user_id => value,
         *      $user2 => value
         * ]
         * 
         * ]
         * 
         * $data baru = [
         * 
         *      $user1 => jumlah value dari semua kriteria,
         *      $user2 => 
         * 
         * ]
         * 
         */
        
        $value = 0;

            foreach($ormawa as $or) {
                foreach($data as $d => $d_value) { //$d (kriteria_id) => $d_value (isi data para users di kriteria itu)
                    foreach($d_value as $user_id => $user_value)
                    {
                        if($or['id'] == $user_id) {
                            $value += $user_value;
                        }
                        
                    }
                }
                
                if(!isset($newData)) {
                    $newData = [$or['nama'] => $value];
                } else {
                    $newData += [$or['nama'] => $value];
                }
                $value = null;

            }

            // dd($newData);
            return $newData;
    }

}
