<?php

namespace Core\Validation;

use Core\Globals\Globals;

class Validator
{
    // TODO mettre en place la validation de formulaire

    private $blobals;
    private $data;
    private $errors = [];

    public function __construct(array $d)
    {
        $this->data = $d;
        $this->globals = new Globals();
    }

    public function validate(array $rules): void
    {
        $this->razErrors();
        
        foreach ($rules as $name => $rulesArray) {
            if (array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    $arg = explode(':', $rule);
                    if (count($arg) > 1) {
                        $args = [];
                        $rule = $arg[0];
                        $args[] = $name;
                        $args[] = $arg[1];
                    } else {
                        $args = (array)$name;
                    }
                    $this->$rule($args);
                }
            }
        }
        if(!empty($this->errors)) {
            $this->storeErrors($this->globals->getServer("HTTP_REFERER"));
        }
    }

    /**
     * Retourne le tableau d'erreurs de validation
     *
     * @return array
     */
    private function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Stocke les erreurs en session
     *
     * @param string $location
     * @return void
     */
    public function storeErrors(string $location)
    {
        $_SESSION['errors'][] = $this->errors;
        header('Location: ' . $location);
        exit;
    }

    /**
     * Vide le tableau d'erreurs et la session erreurs
     *
     * @return void
     */
    public function razErrors()
    {
        if($this->errors) {
            unset($this->errors);
        }
        if($_SESSION['errors'] !== NULL) {
            unset($_SESSION['errors']);
        }
    }

    private function required(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);

        if (!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$key][] = "Le champ $key est requis.";
        }
    }

    private function min(array $args)
    {
        $key = $args[0];
        $condition = (int)$args[1];
        $value = trim($this->data[$args[0]]);

        if (strlen($value) < $condition) {
            $this->errors[$key][] = "Le champ $key doit comporter au moins $condition caractères";
        }
    }

    private function max(array $args)
    {
        $key = $args[0];
        $condition = (int)$args[1];
        $value = trim($this->data[$args[0]]);

        if (strlen($value) > $condition) {
            $this->errors[$key][] = "Le champ $key ne doit pas dépasser $condition caractères";
        }
    }

    private function mail(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$key][] = "$value n'est pas une adresse email valide";
        }
    }

    private function alpha(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if (!ctype_alpha($value)) {
            $this->errors[$key][] = "$value ne contient pas que des lettres";
        }
    }

    private function ctype_alnum(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if (!ctype_alnum($value)) {
            $this->errors[$key][] = "$value ne contient pas que des lettres et des chiffres";
        }
    }
}
