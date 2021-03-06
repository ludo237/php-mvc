<?php

use Arcadia\Migration;

final class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->connection->exec('CREATE TABLE users (
            id BIGSERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )');
    }
    
    public function down()
    {
        $this->connection->exec('DROP TABLE IF EXISTS users');
    }
}
