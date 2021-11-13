<?php

namespace App\Database;

use PDO;
use PDOException;
use App\Config\Config;

/**
 * Singleton pour la base de données
 */
class DBMysql
{
    private $pdo;
    private $config;

    private static $_instance = null;

    private function __construct()
    {
        $this->config = Config::getInstance(CONFIG);
    }

    public static function getInstance()
    {
        if(self::$_instance === null){
            self::$_instance = new DBMysql();
        }
        return self::$_instance;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            try {

                $this->pdo = new PDO(
                    "mysql:dbname={$this->config->get('db.dbName')};
                    host={$this->config->get('db.host')};
                    port={$this->config->get('db.port')};
                    charset=UTF8",
                    $this->config->get('db.userName'),
                    $this->config->get('db.dbPwd'),
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
            }
        }

        return $this->pdo;

        // return $this->pdo ?? $this->pdo = new PDO("mysql:dbname={$this->dbName};host={$this->host};charset=UTF8", $this->userName, $this->pwd);
    }
}
