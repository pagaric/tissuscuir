<?php

/*
Commande pour lancer le serveur interne de PHP
en utilisant server.php pour simuler le fonctionnement
du fichier .htaccess
php -S localhost:8000 -t public server.php
*/
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($url != '/' && file_exists(__DIR__ . '/public' .$url)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = "/index.php";

require_once __DIR__ .'/public/index.php';

