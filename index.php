<?php
define("APP_Root", dirname(__FILE__));
define('CONFIG', require_once APP_Root . '/app/config/config.php');
require_once APP_Root . '/vendor/autoload.php';

session_start();

use App\Core\Route;
use App\Middleware\AuthAdminRoleMiddleware;
use App\middleware\GuestMiddleware;
use App\Middleware\LoginCheckMiddleware;

$router = new Route();
// Define routes
// $router->get('/', 'HomeController@index');
// $router->get('/login/{id}', 'LoginController@login', [LoginController::class, 'demo']);



// $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// Define routes with middleware
$router->addRoute('GET', '/login/{param1}/{param2}/{pa}', 'LoginController@demo', [
    // AuthMiddleware::class,
    // LoggingMiddleware::class
]); //[LoginController::class, 'demo']
$router->addRoute('GET', '/register', 'RegisterController@index', [GuestMiddleware::class]);
$router->addRoute('GET', '/login', 'LoginController@index', [GuestMiddleware::class]);
$router->addRoute('POST', '/register', 'RegisterController@register', [GuestMiddleware::class]);
$router->addRoute('POST', '/login', 'LoginController@login', [GuestMiddleware::class]);
$router->addRoute('GET', '/dashboard', 'DashboardController@index', [LoginCheckMiddleware::class]);
$router->addRoute('GET', '/logout', 'DashboardController@logout', [LoginCheckMiddleware::class]);
$router->addRoute('GET', '/user-list', 'AdminController@user_list', [AuthAdminRoleMiddleware::class]);
$router->addRoute('GET', '/edit-user/{param}', "AdminController@edit_user_by_id", [AuthAdminRoleMiddleware::class]);
$router->addRoute('POST', "/edit-user", 'AdminController@edit_user', [AuthAdminRoleMiddleware::class]);
$router->addRoute('GET', '/delete-user/{param}', 'AdminController@delete_user_by_id', [AuthAdminRoleMiddleware::class]);
$router->addRoute('GET', '/user-post', 'PostController@index', [LoginCheckMiddleware::class]);
$router->addRoute('POST', '/save_post', 'PostController@save_post', [LoginCheckMiddleware::class]);
$router->addRoute('GET', '/all-post-list', 'PostController@all_post_list', [AuthAdminRoleMiddleware::class]);
$router->addRoute('GET', '/approve-post/{param}', 'PostController@approve_post', [AuthAdminRoleMiddleware::class]);
// Parse the current URL
$requestUri = $_SERVER['REQUEST_URI']; //strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    // Resolve the route
    $router->resolve($requestUri, $requestMethod);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
