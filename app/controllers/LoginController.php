<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Utils\JWTUtil;

class LoginController extends Controller
{
    private $jwtUtil;

    public function __construct()
    {

        $this->jwtUtil = new JWTUtil(CONFIG); //$jwtConfig['jwt']
    }
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
                if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                    $token = $this->jwtUtil->generateToken(['id' => $user['id'], 'role' => $user['role']]);
                    //echo json_encode(['token' => $token, 'message' => 'Login successful']);
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode(['token' => $token, 'message' => 'Login successful']);
                } else {
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
                }
            } else {
                if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                    http_response_code(401);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Invalid password.']);
                    return;
                } else {
                    $this->view('login', ['error' => 'Invalid password']);
                }
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Invalid Email And Password']);
                return;
            } else {
                $this->view('login', ['error' => 'Invalid Email And Password']);
            }
        }
    }
}
