<?php

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Main entry point of PHP MVC Framework
 **/

use Arcadia\Application;

// Start the Application itself
$app = new Application();

$app->router->get("/", function () {
    return "Hello World";
});

$app->run();
