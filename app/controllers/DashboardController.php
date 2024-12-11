<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class DashboardController extends Controller
{
    public function index()
    {
        $users = new Users();
        $this->view('dashboard', array('users' => $users->find('id', $_SESSION['user_id'])));
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/login');
    }
}
