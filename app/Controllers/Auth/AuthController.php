<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * Formulaire d'enregistrement
     *
     * @return void
     */
    public function register()
    {
        $title = 'Register';
        return $this->view('auth.register', compact('title'));
    }

    /**
     * Création d'un utilisateur en BDD
     * L'utilisateur dera automatiquement connecté
     *
     * @return void
     */
    public function createUser()
    {
        // TODO mettre en place la protection CSRF
        // TODO mettre en place la validation du formulaire

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

        redirect(route('accueil'));
        exit;
    }

    /**
     * Formulaire d'authentification
     *
     * @return void
     */
    public function login()
    {
        $title = 'Login';
        return $this->view('auth.login', compact('title'));
    }

    /**
     * Authentification d'un utilisateur
     *
     * @return void
     */
    public function authenticate()
    {
        // TODO mettre en place la protection CSRF
        // TODO mettre en place la validation du formulaire
        
        unset($_SESSION['user']);
        unset($_SESSION['messages']);

        $email = $_POST['email'];
        $pass = $_POST['pwd'];

        $user = new User();
        $data = $user->getUser($email);

        if ($data && password_verify($pass, $data->password)) {
            $_SESSION['user'] = $data;
            addFlashMessage('success', 'Vous êtes bien connecté.');

            redirect(route('accueil'));
            exit;
        } else {
            $_SESSION['user'] = NULL;
            addFlashMessage('error', 'Identifiants incorrects.');

            $title = 'Login';
            return $this->view('auth.login', compact('title'));
        }
    }

    /**
     * Déconnexion de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        addFlashMessage('success', 'Vous êtes bien déconnecté.');
        redirect(route('accueil'));
        exit;
    }
}
