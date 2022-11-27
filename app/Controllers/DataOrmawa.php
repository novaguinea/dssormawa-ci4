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
            'data_nilai' => ($this->dataOrmawaModel->getDataByCriterion($id)),
            'files' => $file
        ];

        return view('pages/dataormawa/input_data', $data);
    }

    public function inputData()
    {
        $input = $this->validate([
            'inputDataSupportingFile' => [
                'uploaded[inputDataSupportingFile]',
                'ext_in[inputDataSupportingFile,pdf]',
                'max_size[inputDataSupportingFile,4096]'
            ]
        ]);

        // dd($file = $this->request->getFile('inputDataSupportingFile'));

        if(!$input)
        {
            print("The file is invalid");
        } else
        {

            $file = $this->request->getFile('inputDataSupportingFile');
            // $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads');

            $id = $this->request->getPost('hiddenCriterionId');

            $files = $this->request->getFiles();

            $data = [
                'ormawa_id' => 1,
                'criterion_id' => $id,
                'title' => $this->request->getPost('inputDataTitle'),
                'description' => $this->request->getPost('inputDataDescription'),
                'scoring_id' => $this->request->getPost('inputDataScoring'),
                'file' => $files
            ];

            $this->dataOrmawaModel->addData($data);

            return redirect()->to("ormawa/category/criterion/$id");
        }

    }

    public function viewPDF()
    {
        return redirect()->to("");
    }
    
}
