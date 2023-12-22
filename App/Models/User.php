<?php 

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'user';

    

    public function findUser($column, $value)
    {
        // cette methode doit être utilisée uniquement pour récupérer selon le username ou l'email pour être sûr de n'avoir qu'une seule ligne
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
        $stmt->execute([$value]);

        return $stmt->fetch(\PDO::FETCH_OBJ); // renvoie false ou les infos de l'utilisateur
    }

    public function insertUser($username, $password, $email, $userpicture)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (id_user, username, password, email, userpicture, status) VALUES (NULL, ?, ?, ?, ?, 'ROLE_USER')");
        $stmt->execute([$username, $password, $email, $userpicture]);

        return $stmt->rowCount();
    }

}