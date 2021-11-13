<?php

namespace App\Models;

use PDO;
use App\Database\DBMysql;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {        
        if($this->pdo === null){
            $this->pdo = DBMysql::getInstance()->getPDO();
        }
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->pdo]);
        return $stmt->fetchAll();
    }

    public function getAllApi()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $count != 0 ? $result =  $stmt->fetchAll() : $result = $count;
        return $result;
    }
    
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = (?)");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->pdo]);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}