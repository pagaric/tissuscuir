<?php

namespace App\Controllers;

use Core\Controllers\Controller;


class MainController extends Controller
{

    public function home()
    {
        destroyCsrfToken();
        $title = 'Accueil';
        return $this->view('home', compact('title'));
    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        return $this->view('404');
    }

    public function expired()
    {
        header('HTTP/1.0 419 Expired');
        return $this->view('419');
    }
}