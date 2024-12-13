<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;
use App\Utils\JWTUtil;

class DashboardController extends Controller
{
    public function index()
    {
        $users = new Users();
        $this->view('dashboard', array('users' => $users->find('id', $_SESSION['user_id'])));
    }

    public function logout()
    {
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if (strpos($authHeader, 'Bearer ') !== 0) {
                http_response_code(401);
                echo json_encode(['message' => 'Unauthorized']);
                return;
            }

            $token = substr($authHeader, 7); // Extract token

            // Decode the token to identify the user
            $jwtUtil = new JWTUtil(CONFIG);
            try {
                $decoded = $jwtUtil->verify($token, null);
            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid token.']);
                return;
            }

            // Update user's logout_time in the database
            $users = new Users();
            $users->updateLogoutTime($decoded->id);

            http_response_code(200);
            echo json_encode(['message' => 'Successfully logged out.']);
        } else {
            session_destroy();
            $this->redirect('/login');
        }
    }
}
