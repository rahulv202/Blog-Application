<?php
define("APP_Root", dirname(__FILE__));
define('CONFIG', require_once APP_Root . '/app/config/config.php');
require_once APP_Root . '/vendor/autoload.php';

session_start();

use App\Core\Route;
use App\Middleware\ApiAuthMiddleware;
use App\Middleware\AuthAdminRoleMiddleware;
use App\middleware\GuestMiddleware;
use App\Middleware\LoginCheckMiddleware;

$router = new Route();
// Define routes
// $router->get('/', 'HomeController@index');
// $router->get('/login/{id}', 'LoginController@login', [LoginController::class, 'demo']);



// $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// Define routes with middleware
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
$router->addRoute('GET', '/user-post-manage', 'PostController@user_post_manage', [LoginCheckMiddleware::class]);
$router->addRoute('GET', '/user-post-edit/{param}', 'PostController@user_post_edit', [LoginCheckMiddleware::class]);
$router->addRoute('POST', '/update_user_post', 'PostController@update_user_post', [LoginCheckMiddleware::class]);
$router->addRoute('GET', '/user-post-delete/{param}', 'PostController@user_post_delete', [LoginCheckMiddleware::class]);
$router->addroute('GET', '/', 'HomeController@index', []);
$router->addRoute('GET', '/{param}', 'HomeController@get_post_by_id', []);

// API route with ApiAuthMiddleware
$router->addRoute('POST', '/api/login', 'LoginController@login', []);
$router->addRoute('POST', '/api/register', 'RegisterController@register', []);
$router->addRoute('GET', '/api/user-list', 'AdminController@user_list', [ApiAuthMiddleware::class]);

// Parse the current URL
$requestUri = $_SERVER['REQUEST_URI']; //strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    // Resolve the route
    $router->resolve($requestUri, $requestMethod);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
