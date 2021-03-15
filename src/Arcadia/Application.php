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
    
    public Database $database;
    public Request $request;
    public Response $response;
    public Router $router;
    public Session $session;
    
    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIRECTORY = $rootPath;
        self::$instance = $this;
        
        $this->initDatabase($config["database"]);
    }
    
    public function initHttpLayer() : void
    {
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
    }
    
    private function initDatabase(array $config) : void
    {
        [$driver, $host, $port, $database, $user, $password, $options] = array_values($config);
        
        $this->database = new Database($driver, $host, $port, $database, $user, $password, $options);
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
