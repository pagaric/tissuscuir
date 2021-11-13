<?php

spl_autoload_register('autoload');

function autoload($className)
{
    // Nom du répertoire pour l'autoload
    // $app = "/app/";
    $app = "/../".AUTOLOAD."/";

    // Transforme $className en tableau
    $t = explode('\\', $className);

    // Construit le nom de la classe concernée par le new
    $class = end($t).'.php';

    // Supprime le premier élément du tableau
    unset($t[0]);

    // supprime le dernier élément du tableau
    array_pop($t);

    // Crée le début du chement pour le require
    $chemin = __DIR__. $app;

    // Boucle sur le tableau pour continuer la construction du chemin
    foreach($t as $i){
        $chemin .= $i. '/';
    }

    // Ajoute la classe php en fin de chemin
    $chemin .= $class;

    // Si le fichier existe on effectue le require
    if(file_exists($chemin)){
        require $chemin;
    }
}