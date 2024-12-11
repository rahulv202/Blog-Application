<?php

namespace App\Middleware;

class AuthAdminRoleMiddleware
{
    public function handle($request, $next)
    {
        // Check if the user is authenticated and has the admin role
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
            // User is authenticated and has the admin role, proceed to the next middleware or route handler
            return $next($request);
        }
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            // User is authenticated but does not have the admin role, redirect to the dashboard page
            header('Location: /dashboard');
            exit;
        }
        // User is not authenticated or does not have the admin role, redirect to the login page
        header('Location: /login');
        exit;
    }
}
