<?php

namespace App\Config;

class Config
{

    /**
     * Data chargées depuis le fichier de config
     *
     * @var array
     */
    protected $data;

    /**
     * Valeur par défaut
     *
     * @var mixed
     */
    protected $default = null;

    /**
     * Instance de la classe
     *
     * @var Config
     */
    private static $_instance = null;

    /**
     * Possibilité de construire un objet sans fichier
     *
     * @param path $file
     */
    private function __construct($file = null)
    {
        if($file !== null) {
            $this->data = require $file;
        }
    }

    public static function getInstance($file = null)
    {
        if(self::$_instance === null){
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }

    /**
     * Possibilité de charger un autre fichier
     *
     * @param path $file
     * @return void
     */
    public function load($file)
    {
        $this->data = require $file;
    }

    /**
     * Retourne une valeur du fichier config
     *
     * @param string $key
     * @param [type] $default
     * @return string|null
     */
    public function get(string $key, $default = null)
    {
        $this->default = $default;
        $segments = explode('.', $key);
        $data = $this->data;

        foreach($segments as $segment) {
            if(isset($data[$segment])) {
                $data = $data[$segment];
            } else {
                $data = $this->default;
                break;
            }
        }

        return $data;
    }

    /**
     * Vérifie si une valeur existe
     *
     * @param string $key
     * @return boolean
     */
    public function exists(string $key)
    {
        return $this->get($key) !== $this->default;
    }
}