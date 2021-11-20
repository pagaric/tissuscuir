<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($uri != '/' && file_exists(__DIR__ . '/public' .$uri)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = "/index.php";

require_once __DIR__ .'/public/index.php';