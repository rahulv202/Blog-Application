<?php

namespace App\Middleware;

class LoginCheckMiddleware
{
    public function handle($requestUri, $next)
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            header('Location: /login');
            exit;
        }
        // Continue to the next middleware or controller action
        return $next($requestUri);
    }
}
