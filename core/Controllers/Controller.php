<?php

namespace Core\Controllers;

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

    /**
     * Permet de retourner une vue et de lui passer des paramètres
     * sous forme de tableau
     *
     * @param string $path
     * @param array|null $params (ex: compact('data', 'title'))
     * @return void
     */
    protected function view(string $path, array $params = null)
    {
        ob_start();

        if($params){
            extract($params);
        }
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS .$path. '.html.php';
        
        $content = ob_get_clean();

        require VIEWS .'layouts/layout.html.php';
    }
}