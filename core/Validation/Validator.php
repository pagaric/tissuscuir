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
        return $this->errors;
    }
    
    private function required(array $args)
    {
        d('require');
        d($args);
    }
    
    private function min(array $args)
    {
        d('min');
        d($args);
    }

    private function max(array $args)
    {
        d('max');
        d($args);
    }
    
}