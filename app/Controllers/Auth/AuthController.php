<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Controllers\Controller;
use Core\Validation\Validator;

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
        // protection CSRF
        $token = $this->globals->getPost('csrf_token');
        if (!isset($token) || !verifyCsrfToken($token)) {
            redirect(route('expired'));
            exit;
        }
        destroyCsrfToken();

        // TODO mettre en place la validation du formulaire

        $nom = protectDonnee($_POST['nom']);
        $prenom = protectDonnee($_POST['prenom']);
        $email = protectDonnee($_POST['email']);
        $tel = protectDonnee($_POST['tel']);
        $pwd = password_hash(protectDonnee($_POST['pwd']), PASSWORD_BCRYPT);


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
        // TODO Ajouter fonctionnalité remember me

        // protection CSRF
        $token = $this->globals->getPost('csrf_token');
        if (!isset($token) || !verifyCsrfToken($token)) {
            redirect(route('expired'));
            exit;
        }
        destroyCsrfToken();

        // TODO mettre en place la validation du formulaire
        $validator = new Validator($_POST);
        $validate = $validator->validate([
            'email' => ['min:3', 'required'],
            'pwd' => ['required', 'max:12']
        ]);
        dd('Test en cours');

        unset($_SESSION['user']);
        unset($_SESSION['messages']);

        $email = protectDonnee($_POST['email']);
        $pass = protectDonnee($_POST['pwd']);

        $user = new User();
        $data = $user->getUser($email);

        if ($data && password_verify($pass, $data->password)) {
            $_SESSION['user'] = $data;
            addFlashMessage('success', 'Vous êtes bien connecté.');
            redirect(route('accueil'));
            exit;
        }

        $_SESSION['user'] = NULL;
        addFlashMessage('error', 'Identifiants incorrects.');

        $title = 'Login';
        return $this->view('auth.login', compact('title'));
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
