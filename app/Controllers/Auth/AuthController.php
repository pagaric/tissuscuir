<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Controllers\Controller;

class AuthController extends Controller
{

    public function register()
    {
        $title = 'Register';
        return $this->view('auth.register', compact('title'));
    }

    public function createUser()
    {
        $title = 'Accueil';

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);

        $user = new User();
        $user->createUser($nom, $prenom, $email, $tel, $pwd);

        // Authentification automatique après enregistrement
        $data = $user->getUser($email);
        $_SESSION['user'] = $data;
        addFlashMessage('success', 'Vous êtes bien enregistré.');

        return $this->view('home', compact('title'));
    }

    public function login()
    {
        $title = 'Login';
        return $this->view('auth.login', compact('title'));
    }

    public function authenticate()
    {
        unset($_SESSION['user']);
        unset($_SESSION['messages']);

        $email = $_POST['email'];
        $pass = $_POST['pwd'];

        $user = new User();
        $data = $user->getUser($email);
        
        if ($data && password_verify($pass, $data->password)) {
            $_SESSION['user'] = $data;
            addFlashMessage('success', 'Vous êtes bien connecté.');

            $title = 'Accueil';
            return $this->view('home', compact('title'));
        } else {
            $_SESSION['user'] = NULL;
            addFlashMessage('error', 'Identifiants incorrects.');

            $title = 'Login';
            return $this->view('auth.login', compact('title'));
        }
    }

    public function logout()
    {
    }
}
