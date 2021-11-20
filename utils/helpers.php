<?php

use App\Config\Config;

$config = Config::getInstance(CONFIG);

require_once(dirname(__DIR__) . '/app/Routes/routesWeb.php');

/**
 * Construit une url complète
 *
 * @param string $url
 * @return string
 */
function url(string $url): string
{
    global $config;
    return $config->get('url'). $url;
}

/**
 * Permet de retourner l'url à partir du nom de la route
 *
 * @param string $name
 * @param array $params
 * @return string
 */
function route(string $name, array $params = []): string
{
    global $router;
    $url = $router->getPathNamedRoute($name);

    if (!empty($params)) {
        $url = preg_Replace('#:([\w]+)#', $params[0], $url);
    }
    return $url;
}

/**
 * Ajout de message flash
 *
 * @param string $categorie
 * @param string $message
 * @return void
 */
function addFlashMessage(string $categorie, string $message)
{
    $_SESSION['messages'][$categorie] = $message;
}

/**
 * Affichage de message s'il existe
 *
 * @param string $categorie
 * @return string
 */
function printIfHasFlashMessage(string $categorie): ?string
{
    if(isset($_SESSION['messages'][$categorie]) && !empty($_SESSION['messages'][$categorie])){
        $message =  $_SESSION['messages'][$categorie];
        unset($_SESSION['messages'][$categorie]);
        return $message;
    } else {
        return NULL;
    }
}
/* ==================== Helpers de debug ===================== */
function d($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

function r($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function rd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}
