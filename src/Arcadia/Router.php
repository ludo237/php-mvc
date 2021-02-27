<?php

namespace Arcadia;

use Closure;
use Exception;

/**
 * Class Router
 * @package Arcadia
 */
class Router
{
    protected array $routes = [];
    protected Request $request;
    
    
    /**
     * Router constructor.
     *
     * @param \Arcadia\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * @param string $path
     * @param \Closure $callback
     *
     * @return \Arcadia\Router
     */
    public function get(string $path, Closure $callback) : self
    {
        $this->routes["get"][$path] = $callback;
        
        return $this;
    }
    
    /**
     * @throws \Exception
     */
    public function resolve() : void
    {
        $pathURI = $this->request->serverPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$pathURI] ?? false;
        
        if (!$callback) {
            throw new Exception("Path not found");
        }
        echo call_user_func($callback);
    }
}
