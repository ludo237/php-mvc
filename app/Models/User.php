<?php

namespace App\Models;

use Arcadia\Model;

class User extends Model
{
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirm;
    
    public function rules() : array
    {
        return [
            "name" => [
                "required",
            ],
            "email" => [
                "required",
                "email",
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
    
    public function create()
    {
        // TODO alpha 3
    }
}
