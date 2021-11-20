<?php

namespace App\Controllers;

use Core\Controllers\Controller;


class MainController extends Controller
{

    public function home()
    {
        $title = 'Accueil';
        return $this->view('home', compact('title'));
    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        return $this->view('404');
    }
}