<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    //masukin pagenya di folder view/pages/... jadi input pake pages

    public function login()
    {

        $data = [
            'title' => 'Login'
        ];

        return view('pages/users/login', $data);
    }
    
}
