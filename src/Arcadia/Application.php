<?php

namespace Arcadia;

/**
 * Class Application
 * @package Arcadia
 */
class Application
{
    public static Application $instance;
    public static string $ROOT_DIRECTORY;
    
    public Router $router;
    public Request $request;
    public Response $response;
    
    /**
     * Application constructor.
     *
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIRECTORY = $rootPath;
        self::$instance = $this;
        
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
    }
    
    /**
     * Run the application
     * @throws \Exception
     */
    public function run() : void
    {
        echo $this->router->resolve();
    }
}
