<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\CriterionModel;
use App\Models\ScoringModel;
use App\Models\VariableModel;
use App\Models\UserRoleModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->variableModel = new VariableModel();
        $this->criterionModel = new CriterionModel();
        $this->scoringModel = new ScoringModel();
        $this->userRoleModel = new UserRoleModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index() //showing all account in table
    {
        $data = [
            'title' => 'data user',
            'users' => $this->userModel->getUsers(),
            'user_role' => $this->userRoleModel->getDataRoles(),
            'role_id' => $this->session->get('role_id')
        ];

        return view('pages/users/index', $data);
    }
    
    public function add()
    {
        $data = [
            'title' => 'Add New Account',
            'role_id' => $this->session->get('role_id'),
            'user_role' => $this->userRoleModel->getDataRoles(),
            'ormawa_data' => $this->userModel->getAllOrmawaUsers()
        ];

        return view('pages/users/add_user', $data);
    }

    public function delete($id)
    {
        $this->userModel->deleteUser($id);

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

        if($valid['role_id'] == 1)
        {
            return redirect()->to('/ormawa/category');
        } else if($valid['role_id'] == 4) 
        {
            return redirect()->to('/data/ormawa');
        } else {
            return redirect()->to('/data');
        }
        
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
            'role_id' => $this->request->getPost("userRoleId"),
            'ormawa_related' => $this->request->getPost("ormawaRelatedId")
        ]);

        return redirect()->to('/users');

    }

    //sakit perut!!!!

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to("/");
    }


}
