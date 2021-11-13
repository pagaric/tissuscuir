<?php

namespace App\Controllers;

use App\Config\Config;
use App\Config\Globals;

abstract class Controller
{
    protected $config;
    // protected $globals;

    public function __construct()
    {
        $this->config = Config::getInstance(CONFIG);
        // $this->globals = Globals::getInstance();
    }

    protected function view(string $path, array $params = null)
    {
        ob_start();

        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS .$path. '.html.php';
        
        $content = ob_get_clean();

        require VIEWS .'layout.html.php';
    }
}