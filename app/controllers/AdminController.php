<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class AdminController extends Controller
{

    public function user_list()
    {
        $users = new Users();
        $this->view('user_list', ['users' => $users->getAllData()]);
    }
}
