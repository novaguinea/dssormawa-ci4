<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    
}
