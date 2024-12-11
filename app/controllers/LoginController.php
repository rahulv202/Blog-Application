<?php

namespace App\Controllers;

use App\Core\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }
    public function demo($param1, $param2, $param3)
    {
        echo "Demo method called with params: $param1, $param2, $param3";
    }
}
