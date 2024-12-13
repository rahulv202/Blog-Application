<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Utils\JWTUtil;

class RegisterController extends Controller
{
    private $jwtUtil;

    public function __construct()
    {

        $this->jwtUtil = new JWTUtil(CONFIG); //$jwtConfig['jwt']
    }
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
                if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode(['message' => 'Registration successful']);
                } else {
                    $this->redirect('/login');
                }
            } else {
                if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                    http_response_code(401);
                    header('Content-Type: application/json');
                    echo json_encode(['message' => 'Registration failed']);
                } else {
                    $this->view('register', ['error' => 'Registration failed']);
                }
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'User already exists']);
            } else {
                $this->view('register', ['error' => 'User already exists']); //Email
            }
        }
    }
}
