<?php

use App\Controllers\Auth\AuthController;
use App\Core\Routes\Router;
use App\Controllers\MainController;
use App\Controllers\UserController;

$url = "";
if(!empty($_GET) && $_GET['url'] != null ){
    $url = $_GET['url'];
}

$router = new Router($url);

// Génération du hash de "pass"
$router->get('/hash', [UserController::class, 'showHash']);

// Routes de l'application
$router->get('/', [MainController::class, 'home'], 'accueil');
$router->get('/users', [UserController::class, 'index'], 'allUsers');

// Authentification
$router->get('/register', [AuthController::class, 'register'], 'register');
$router->post('/register', [AuthController::class, 'createUser'], 'create.user');

$router->get('/login', [AuthController::class, 'login'], 'login');
$router->post('/login', [AuthController::class, 'authenticate'], 'authenticate');

$router->get('/logout', [AuthController::class, 'logout'], 'logout');

// Route 404
$router->get('/404', [MainController::class, 'notFound'], 'notFound');

/**
 * Permet de retourner l'url à partir du nom de la route
 *
 * @param string $name
 * @return string
 */
function route(string $name): string
{
    global $router;
    return $router->getPathNamedRoute($name);
}

/**
 * démarre le router
 */
$router->run();
