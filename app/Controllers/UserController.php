<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    
    /**
     * Génération d'un hash pour les tests
     *
     * @return string
     */
    public function showHash(): string
    {
        $toHash = 'pass';
        echo password_hash($toHash, PASSWORD_BCRYPT);
        die();
    }

    public function index()
    {
        $user = new User;
        $data = $user->getAll();
        $title = 'Tous les utilisateurs';

        return $this->view('users', compact('data', 'title'));
    }
    
}