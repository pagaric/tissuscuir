<?php

use App\Routes\Router;
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
