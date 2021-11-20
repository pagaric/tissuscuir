<?php

namespace App\Models;

use Core\Models\Model;


class User extends Model
{
    protected $table = 'users';

    public function createUser($nom, $prenom, $email, $tel, $pwd)
    {
        $sql = "INSERT INTO " .$this->table. " (nom, prenom, email, tel, password)";
        $sql .= " VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $tel, $pwd]);
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}