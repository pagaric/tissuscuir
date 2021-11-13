<?php

use App\Routes\Router;
use App\Controllers\ApiController;
use App\Controllers\BlogController;

$url = "";
if(!empty($_GET) && $_GET['url'] != null ){
    $url = $_GET['url'];
}

$router = new Router($url);

// $router->get('/', 'App\Controllers\BlogController@welcome');
// $router->get('/posts', 'App\Controllers\BlogController@index');
// $router->get('/posts/:id', 'App\Controllers\BlogController@show');

$router->get('/', [BlogController::class, 'welcome'], 'accueil');
$router->get('/posts', [BlogController::class, 'index'], 'get.posts');
$router->get('/posts/:id', [BlogController::class, 'show'], 'get.postId');
$router->get('/hello', [BlogController::class, 'hello']);

$router->get('/api/posts', [ApiController::class, 'index']);

function route($name)
{
    global $router;
    return $router->getPathNamedRoute($name);
}

$router->run();
