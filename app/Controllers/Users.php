<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->variableModel = new VariableModel();
        $this->criterionModel = new CriterionModel();
        $this->scoringModel = new ScoringModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index() //showing all account in table
    {
        $data = [
            'title' => 'data user',
            'users' => $this->userModel->getUsers()
        ];

        return view('pages/users/index', $data);
    }
    
    public function add()
    {
        $data = [
            'title' => 'Add New Account'
        ];

        return view('pages/users/add_user', $data);
    }

    public function delete($id)
    {
        $this->userModel->deleteUser($id);

        $data = [
            'title' => 'data user'
        ];

        return redirect()->to('/users');
    }

    public function login()
    {
        $category = $this->categoryModel->getCategories();
        $data = [
            'title' => 'Home',
            'username' => $this->request->getPost("inputUsernameLogin"),
            'password' => $this->request->getPost("inputPwdLogin"),
            'category' => $category
        ];

        // dd($data);

        $valid = $this->userModel->getUserByUsername($data['username']);

        if(!$valid)
        {
            return redirect()->to('/login');
        } else 
        {
            if($data['password'] != $valid['password'])
            {
                return redirect()->to('/login');
            }
        }

        $this->session->set($valid);

        if($valid['is_ormawa'] != null)
        {
            return redirect()->to('/ormawa/category');
        }
        
        return redirect()->to('/users');
    
    }

    // public function detail($id)
    // {
    //     $data = [
    //         'title' => 'Details',
    //         'users' => $this->userModel->getUserById($id)
    //     ];

    //     return view('pages/users/detail_user', $data);
    // }
    
    public function saveUser()
    {
        // dd($this->request->getVar());
        $this->userModel->insert([
            'username' => $this->request->getPost("inputUsername"),
            'password' => $this->request->getPost("inputPassword"),
            'nama' => $this->request->getPost("inputNama"),
            'role_id' => 1 //by default new user is ORMAWA
        ]);

        return redirect()->to('/users');

    }


}
