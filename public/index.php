<?php
session_start();

/**
 * Import de l'autoloader
 */
// require __DIR__. '/../utils/autoloader.php';

/**
 * Import de l'autoloader de composer
 */
require dirname(__DIR__) .'/vendor/autoload.php';


/**
 * Chemin vers le dossier vues
 */
define('VIEWS', dirname(__DIR__) .DIRECTORY_SEPARATOR. 'app/views' .DIRECTORY_SEPARATOR);

/**
 * Chemin vers le dossier public
 */
// define('ASSETS', dirname($_SERVER['SCRIPT_NAME']).'public/');

/**
 * Chemin du fichier config.php
 */
define('CONFIG', dirname(__DIR__) .DIRECTORY_SEPARATOR. 'config.php');

/**
 * Nom du dossier pour l'autoload perso
 */
define('AUTOLOAD', 'app');

/**
 * Import du fichier helpers
 * et des routes
 */
require dirname(__DIR__). '/core/utils/helpers.php';

/**
 * import des routes
 * require dans le fichier helpers.php
 */
// require_once dirname(__DIR__). '/app/Routes/routesWeb.php';
