<?php

use App\Config\Config;

$config = Config::getInstance(CONFIG);

require_once(dirname(__DIR__) . '/../app/Routes/routesWeb.php');

#region Validation données

/**
 * Protection de base d'une chaine de caractère
 *
 * @param string $donnee
 * @return string
 */
function protectDonnee(string $donnee): string
{
    $donnee = trim($donnee);
    $donnee = stripslashes($donnee);
    $donnee = htmlspecialchars($donnee);
    return $donnee;
}

/**
 * Vérification d'une adresse mail
 *
 * @param string $mail
 * @return boolean
 */
function isEmail(string $mail): bool
{
    $test = filter_var($mail, FILTER_VALIDATE_EMAIL);
    
    return $test ? true : false;
}

#endregion

#region CSRF protection

/**
 * Génération d'un token pour le système de protection CSRF
 *
 * @return string
 */
function genCsrfToken(): string
{
    global $config;
    return bin2hex(random_bytes($config->get('tokenLenght')/2));
}

/**
 * Stocke un token en session
 *
 * @return void
 */
function storeCsrfToken(): void
{
    $_SESSION['csrf_token'] = genCsrfToken();
    $_SESSION['csrf_token_time'] = time();
}

/**
 * Vérification du token
 *
 * @param string $token
 * @return boolean
 */
function verifyCsrfToken(string $token): bool
{
    global $config;
    return ($_SESSION['csrf_token'] === $token
        && time() <= ($_SESSION['csrf_token_time'] + $config->get('tokenPeriodValidity')));
}

/**
 * Retourne le token
 *
 * @return string|null
 */
function getCsrfToken(): ?string
{
    if(isset($_SESSION['csrf_token'])) {
        return $_SESSION['csrf_token'];
    } else {
        return NULL;
    }
}

/**
 * Détruit le token CSRF
 *
 * @return void
 */
function destroyCsrfToken(): void
{
    if(isset($_SESSION['csrf_token'])) {
        unset( $_SESSION['csrf_token'] );
        unset( $_SESSION['csrf_token_time'] );
    }
}

/**
 * Génère un champ de type hiddes pour le token
 * usage: <?= genInputCsrfToken() ?>
 *
 * @return string
 */
function genInputCsrfToken(): string
{
    if(getCsrfToken() != NULL) {
        destroyCsrfToken();
    }
    storeCsrfToken();
    $token = getCsrfToken();
    return "<input type=\"hidden\" name=\"csrf_token\" value=\"" .$token. "\">";
}

#endregion

#region Routes/URL
/**
 * Construit une url complète
 *
 * @param string $url
 * @return string
 */
function url(string $url = ''): string
{
    global $config;
    return $config->get('url'). '/' .$url;
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
 * Permet de pointer vers le dossier public
 *
 * @param string $url
 * @return string
 */
function asset(string $url): string
{
    global $config;
    return $config->get('url'). '/public/' .$url;
}

function redirect(string $r)
{
    header('Location: ' .$r);
}

#endregion

#region SESSION
/**
 * Ajout de message flash
 *
 * @param string $categorie (ex: error, success)
 * @param string $message (ex: vous êtes bien connecté)
 * @return void
 */
function addFlashMessage(string $categorie, string $message)
{
    $_SESSION['messages'][$categorie] = $message;
}

/**
 * Affichage de message s'il existe et suppression du message
 *
 * @param string $categorie
 * @return string
 */
function printIfHasFlashMessage(string $categorie): ?string
{
    if(isset($_SESSION['messages'][$categorie]) && !empty($_SESSION['messages'][$categorie])){
        $message =  $_SESSION['messages'][$categorie];
        unset($_SESSION['messages']);
        return $message;
    } else {
        return NULL;
    }
}

#endregion

#region Debug


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

#endregion
