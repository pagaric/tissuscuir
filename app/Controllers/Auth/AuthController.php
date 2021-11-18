<?php

namespace App\Controllers\Auth;

use App\Core\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        $title = 'Register';
        return $this->view('auth.register', compact('title'));
    }

    public function createUser()
    {
        $title = 'Register';

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);

        $user = new User();
        $user->createUser($nom, $prenom, $email, $tel, $pwd);

        return $this->view('auth.register', compact('title'));
    }

    public function login()
    {
        $title = 'Login';
        return $this->view('auth.login', compact('title'));
    }

    public function authenticate()
    {
        unset($_SESSION['user']);

        $email = $_POST['email'];
        $pass = $_POST['pwd'];

        $user = new User();
        $data = $user->getUser($email);
        if($data){
            $_SESSION['user'] = $data;
        }
        dd($_SESSION['user']);
    }

    public function logout()
    {

    }
}