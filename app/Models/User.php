<?php

namespace App\Models;

use Arcadia\Application;
use Arcadia\Model;

class User extends Model
{
    public static string $table = "users";
    
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirm;
    
    public static function registerRules() : array
    {
        return [
            "name" => [
                "required",
            ],
            "email" => [
                "required",
                "email",
                "unique:users.email",
            ],
            "password" => [
                "required",
                "min:8",
            ],
            "password_confirm" => [
                "required",
                "min:8",
                "match:password",
            ],
        ];
    }
    
    public static function loginRules() : array
    {
        return [
            "email" => [
                "required",
                "email",
                // TODO add exists rule
            ],
            
            "password" => [
                "required",
                "min:8",
            ],
        ];
    }
    
    public function first(array $parameters = ["*"]) : Model
    {
        $tableName = self::$table;
        $columns = array_keys($parameters);
        $statement = implode("AND", array_map(fn($attribute) => "$attribute = :$attribute", $columns));
        
        $sql = Application::$instance->database->connection->prepare("
            SELECT * FROM {$tableName} WHERE {$statement}
        ");
        
        foreach ($parameters as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
        
        $sql->execute();
        
        return $sql->fetchObject(self::class);
    }
    
    public function create() : Model
    {
        $tableName = self::$table;
        
        $sql = Application::$instance->database->connection->prepare("
            INSERT INTO $tableName (name, email, password)
            VALUES (:name, :email, :password)
        ");
        
        $sql->bindValue(":name", $this->name);
        $sql->bindValue(":email", $this->email);
        $sql->bindValue(":password", password_hash($this->password, PASSWORD_ARGON2I));
        
        $sql->execute();
        
        return $this;
    }
}
