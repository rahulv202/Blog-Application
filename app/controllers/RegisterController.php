<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view('register');
    }

    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $user = new Users();
        $result = $user->save(['name', 'email', 'password', 'role'], [$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
        if ($result) {
            $this->redirect('/login');
        } else {
            $this->view('register', ['error' => 'Registration failed']);
        }
    }
}
