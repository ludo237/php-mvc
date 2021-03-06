<?php

namespace Arcadia;

use PDO;

class Migration
{
    protected PDO $connection;
    
    public function __construct()
    {
        $this->connection = Application::$instance->database->connection;
    }
}
