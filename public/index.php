<?php

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Main entry point of PHP MVC Framework
 **/

use Arcadia\Application;

// Start the Application itself
$app = new Application(dirname(__DIR__));

$app->router->view("home", "/");
$app->router->post("/", function () {
    return "Submitted";
});
$app->router->view("about");

$app->run();
