<?php

namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
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
