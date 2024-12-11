<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new Users();
        $user = $user->find('email', $email);
        // print_r($user);
        // die;
        if (!empty($user)) {
            if (password_verify($password, $user['password'])) {
                // Authenticate the user
                // Store user information in session variables
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role']; //user_role
                //$this->view('dashboard');
                $this->redirect('/dashboard');
            } else {
                $this->view('login', ['error' => 'Invalid password']);
            }
        } else {
            $this->view('login', ['error' => 'Invalid Email And Password']);
        }
    }
    public function demo($param1, $param2, $param3)
    {
        echo "Demo method called with params: $param1, $param2, $param3";
    }
}
