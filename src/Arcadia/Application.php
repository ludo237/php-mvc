<?php

namespace Arcadia;

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
    public function __construct()
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
