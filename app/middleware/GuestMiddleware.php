<?php

namespace App\Middleware;

class GuestMiddleware
{

    public function handle($requestUri,  $next)
    {
        if (isset($_SESSION['user_id'])) {
            // Redirect to dashboard
            header('Location: /dashboard');
            exit;
        }

        // Continue to the next middleware or final action
        return $next($requestUri);
    }
}
