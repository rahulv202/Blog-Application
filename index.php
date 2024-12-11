<?php
define("APP_Root", dirname(__FILE__));
define('CONFIG', require_once APP_Root . '/app/config/config.php');
require_once APP_Root . '/vendor/autoload.php';

session_start();

use App\Core\Route;
use App\middleware\GuestMiddleware;


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
// Parse the current URL
$requestUri = $_SERVER['REQUEST_URI']; //strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    // Resolve the route
    $router->resolve($requestUri, $requestMethod);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
