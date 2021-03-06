<?php

namespace Arcadia;

use PDO;

class Database
{
    public PDO $connection;
    
    public function __construct(
        string $driver,
        string $host,
        int $port,
        string $databaseName,
        string $user,
        string $password,
        array $options = []
    ) {
        $dns = "{$driver}:host={$host};port={$port};dbname={$databaseName}";
        
        $this->connection = new PDO($dns, $user, $password, $options);
        
        // Raise exceptions
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function createMigrationsTable() : void
    {
        $this->connection->exec('CREATE TABLE IF NOT EXISTS migrations (
        id BIGSERIAL PRIMARY KEY,
        migration VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )');
    }
    
    public function fetchMigrations() : array
    {
        $query = $this->connection->prepare('SELECT migration FROM migrations');
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function resolveMigrationFileName(mixed $migration) : string
    {
        require_once Application::$ROOT_DIRECTORY . "/database/migrations/${migration}";
        $fileName = pathinfo($migration, PATHINFO_FILENAME);
        $fileName = implode("_", array_slice(explode("_", $fileName), 1));
        
        return str_replace("_", '', ucwords($fileName, "_"));
    }
    
    public function saveMigrations(array $migrationsToSave) : void
    {
        if (count($migrationsToSave) <= 0) {
            return;
        }
        
        $this->connection
            ->prepare('INSERT INTO migrations (migration) VALUES (?)')
            ->execute($migrationsToSave);
    }
}
