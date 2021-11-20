<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controllers\Controller;

class UserController extends Controller
{
    
    /**
     * Génération d'un hash pour les tests
     *
     * @param string $toHash
     * @return string
     */
    public function showHash(string $toHash): string
    {
        // $toHash = 'pass';
        echo password_hash($toHash, PASSWORD_BCRYPT);
        die();
    }

    public function index()
    {
        $title = 'Tous les utilisateurs';
        
        $user = new User();
        $data = $user->getAll();

        return $this->view('users', compact('data', 'title'));
    }
    
}