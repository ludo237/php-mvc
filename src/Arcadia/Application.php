<?php

namespace Arcadia;

use JetBrains\PhpStorm\Pure;

/**
 * Class Application
 * @package Arcadia
 */
class Application
{
    public Router $router;
    public Request $request;
    
    /**
     * Application constructor.
     */
    #[Pure] public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }
    
    /**
     * Run the application
     * @throws \Exception
     */
    public function run() : void
    {
        $this->router->resolve();
    }
}
