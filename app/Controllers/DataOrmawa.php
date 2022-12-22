<?php

namespace App\Controllers;

use App\Models\DataOrmawaModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;

use CodeIgniter\Files\File;

class DataOrmawa extends BaseController
{

    public function __construct()
    {
        $this->dataOrmawaModel = new DataOrmawaModel();
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
        $file = $this->request->getFile('inputDataSupportingFile');

        $data = [
            'title' => 'Isi Data ORMAWA',
            'criterion' => $this->criterionModel->getCriterionById($id),
            'scoring' => $this->scoringModel->getScoringByCriterion($id),
            'data_nilai' => $this->dataOrmawaModel->getDataByCriterion($id),
            'ormawa_id' => 2,
            'files' => $file
        ];

        return view('pages/dataormawa/input_data', $data);
    }

    public function inputData()
    {
        $x = $this->request->getPost('inputDataScoring');

            $file = $this->request->getPost('fileURL');
            // $fileName = $file->getRandomName();

            $id = $this->request->getPost('hiddenCriterionId');

            // dd($this->request->getPost('inputDataScoring'));

            $data = [
                'ormawa_id' => 2,
                'criterion_id' => $id,
                'title' => $this->request->getPost('inputDataTitle'),
                'description' => $this->request->getPost('inputDataDescription'),
                'score' => $x,
                'scope' => $this->request->getPost('inputDataScoringDesc'),
                'file' => $file
            ];
            
            $this->dataOrmawaModel->addData($data);
            
            return redirect()->to("ormawa/category/criterion/$id");
        }

    }


