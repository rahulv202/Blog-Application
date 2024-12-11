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
        if (empty($user->find('email', $email))) {
            $result = $user->save(['name', 'email', 'password', 'role'], [$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
            if ($result) {
                // $this->view('login');
                $this->redirect('/login');
            } else {
                $this->view('register', ['error' => 'Registration failed']);
            }
        } else {
            $this->view('register', ['error' => 'User already exists']); //Email
        }
    }
}
