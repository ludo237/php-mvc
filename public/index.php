<?php

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Main entry point of PHP MVC Framework
 **/

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\UpdateNameController;
use Arcadia\Application;

// Start the Application
$app = new Application(dirname(__DIR__));

// TODO move to a dedicated file
$app->router->get("/", HomeController::class);
$app->router->post("/", UpdateNameController::class);
$app->router->get("/about", AboutController::class);

$app->router->get("/login", LoginController::class);
$app->router->post("/login", LoginController::class);

$app->router->get("/register", RegisterController::class);
$app->router->post("/register", RegisterController::class);

$app->run();
