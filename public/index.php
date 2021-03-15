<?php

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\UpdateNameController;
use App\Models\User;
use Arcadia\Application;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . "/vendor/autoload.php";

// TODO: I don't like this. Config should be moved away
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    "database" => include_once dirname(__DIR__) . "/configs/database.php",
];

// Start the Application
$app = new Application(dirname(__DIR__), $config);

$app->setAuthModel(User::class);

// TODO move to a dedicated file
$app->initHttpLayer();

$app->router->get("/", HomeController::class);
$app->router->post("/", UpdateNameController::class);
$app->router->get("/about", AboutController::class);

$app->router->get("/login", LoginController::class);
$app->router->post("/login", LoginController::class);

$app->router->get("/register", RegisterController::class);
$app->router->post("/register", RegisterController::class);

$app->run();
