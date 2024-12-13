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
        $users = $user->find('email', $email);
        // print_r($user);
        // die;
        if (!empty($users)) {
            if (password_verify($password, $users['password'])) {
                // Authenticate the user
                if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                    $data = $user->updateLogoutTimeRomve($users['id']);
                    $token = $this->jwtUtil->generateToken(['id' => $users['id'], 'role' => $users['role']]);
                    //echo json_encode(['token' => $token, 'message' => 'Login successful']);
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode(['token' => $token, 'message' => 'Login successful']);
                } else {
                    // Store user information in session variables
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_id'] = $users['id'];
                    $_SESSION['user_name'] = $users['name'];
                    $_SESSION['user_email'] = $users['email'];
                    $_SESSION['user_id'] = $users['id'];
                    $_SESSION['user_name'] = $users['name'];
                    $_SESSION['user_email'] = $users['email'];
                    $_SESSION['role'] = $users['role']; //user_role
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
