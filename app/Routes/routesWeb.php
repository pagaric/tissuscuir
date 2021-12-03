<?php

use Core\Routes\Router;
use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Controllers\Auth\AuthController;
use Core\Globals\Globals;

// $url = "";
// if (!empty($_GET) && $_GET['url'] != null) {
//     $url = $_GET['url'];
// }
$globals = new Globals;

$url = parse_url($globals->getServer('REQUEST_URI'), PHP_URL_PATH);
$router = new Router($url);

// Génération du hash de "pass"
$router->get('/hash/:tohash', [UserController::class, 'showHash'], 'showHash');

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
// Route 419
$router->get('/419', [MainController::class, 'expired'], 'expired');

/**
 * démarre le router
 */
$router->run();
