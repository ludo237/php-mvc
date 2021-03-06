<?php

use Arcadia\Application;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . "/vendor/autoload.php";

// TODO: I don't like this. Config should be moved away
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    "database" => include_once dirname(__DIR__) . "/configs/database.php",
];

$app = new Application(dirname(__DIR__), $config);

$app->database->createMigrationsTable();

$migrationsFiles = array_diff(
    scandir(Application::$ROOT_DIRECTORY . "/database/migrations"),
    [".", ".."]
);

$migrations = array_diff($migrationsFiles, $app->database->fetchMigrations());

$migrationsToSave = [];

foreach ($migrations as $migration) {
    $fileName = $app->database->resolveMigrationFileName($migration);

    echo "Applying migration {$migration}" . PHP_EOL;
    $startTime = microtime(true);
    $instance = new $fileName;
    $instance->up();
    $endTime = microtime(true);
    $elapsed = $endTime - $startTime;
    echo "Applied migration {$migration} ({$elapsed} s)" . PHP_EOL;

    $migrationsToSave[] = $migration;
}

$app->database->saveMigrations($migrationsToSave);

echo "Migrations applied" . PHP_EOL;
