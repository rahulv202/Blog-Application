<?php

namespace App\Middleware;

use App\Models\Users;
use App\Utils\JWTUtil;

class ApiAuthMiddleware
{
    private $jwtUtil;
    public function __construct()
    {
        $this->jwtUtil = new JWTUtil(CONFIG);
    }

    public function handle($requestUri, $next)
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (strpos($authHeader, 'Bearer ') !== 0) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }

        $token = substr($authHeader, 7);

        try {
            // Decode token and verify logout time
            $decoded = $this->jwtUtil->verify($token, null);
            $userModel = new Users();
            $logoutTime = $userModel->getDataColumnName(['logout_time'], "id=$decoded->id"); //getLogoutTime
            // print_r($logoutTime[0]['logout_time']);
            // exit();
            $this->jwtUtil->verify($token, $logoutTime[0]['logout_time']);
            //$request['user'] = $decoded;
            if ($decoded->role == 'admin') {
                $Admin_url = array('/user-list', '/edit-user', '/delete-user', '/all-post-list', '/approve-post');
                // print_r($requestUri);
                // echo explode('/', $requestUri)[2];
                // exit();
                if (in_array(('/' . explode('/', $requestUri)[2]), $Admin_url) && $decoded->role == 'admin') {
                    $next($requestUri);
                } else {
                    http_response_code(401);
                    echo json_encode(['message' => 'Unauthorized']);
                    return;
                }
            }
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => $e->getMessage()]);
            return;
        }

        return $next($requestUri);
    }
}
