<?php
namespace Core\Validation;

class Validator
{
    // TODO mettre en place la validation de formulaire

    private $data;
    private $errors = [];

    public function __construct(array $d)
    {
        $this->data = $d;
    }

    public function validate(array $rules): ?array
    {
        foreach($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)) {
                foreach($rulesArray as $rule) {
                    $arg = explode(':',$rule);
                    if(count($arg) > 1) {
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
        // dd($this->errors);
        return $this->getErrors();
    }

    private function getErrors()
    {
        return $this->errors;
    }
    
    private function required(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);

        if(!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$key][] = "Le champ $key est requis.";
        } 
    }
    
    private function min(array $args)
    {
        $key = $args[0];
        $condition = (int)$args[1];
        $value = trim($this->data[$args[0]]);

        if(strlen($value) < $condition) {
            $this->errors[$key][] = "Le champ $key doit comporter au moins $condition caractères";
        }
    }

    private function max(array $args)
    {
        $key = $args[0];
        $condition = (int)$args[1];
        $value = trim($this->data[$args[0]]);

        if(strlen($value) > $condition) {
            $this->errors[$key][] = "Le champ $key ne doit pas dépasser $condition caractères";
        }
    }

    private function mail(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$key][] = "$value n'est pas une adresse email valide";
        }
    }

    private function alpha(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if(!ctype_alpha($value)) {
            $this->errors[$key][] = "$value ne contient pas que des lettres";
        }
    }

    private function ctype_alnum(array $args)
    {
        $key = $args[0];
        $value = trim($this->data[$args[0]]);
        if(!ctype_alnum($value)) {
            $this->errors[$key][] = "$value ne contient pas que des lettres et des chiffres";
        }
    }
    
}