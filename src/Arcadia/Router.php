<?php

namespace Arcadia;

use Closure;

/**
 * Class Router
 * @package Arcadia
 */
class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;
    
    
    /**
     * Router constructor.
     *
     * @param \Arcadia\Request $request
     * @param \Arcadia\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    
    /**
     * @param string $method
     * @param string $path
     * @param string|callable $value
     */
    private function addRouteToList(string $method, string $path, callable|string $value) : void
    {
        $this->routes[$method][$path] = $value;
    }
    
    /**
     * @param string $path
     * @param \Closure $callback
     *
     * @return $this
     */
    public function get(string $path, Closure $callback) : self
    {
        $this->addRouteToList("get", $path, $callback);
        
        return $this;
    }
    
    /**
     * @param string $path
     * @param \Closure $callback
     *
     * @return $this
     */
    public function post(string $path, Closure $callback) : self
    {
        $this->addRouteToList("post", $path, $callback);
        
        return $this;
    }
    
    /**
     * @param string $viewName
     * @param string|null $path
     *
     * @return $this
     */
    public function view(string $viewName, ?string $path = null) : self
    {
        if (is_null($path)) {
            $path = "/{$viewName}";
        }
        
        $this->addRouteToList("get", $path, $viewName);
        
        return $this;
    }
    
    /**
     * @throws \Exception
     */
    public function resolve()
    {
        $pathURI = $this->request->serverPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$pathURI] ?? false;
        
        if (!$callback) {
            $this->response->status(404);
            
            return $this->renderError(404);
        }
        
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        
        return call_user_func($callback);
    }
    
    public function renderView(string $view) : array|bool|string
    {
        $layout = $this->resolveLayout();
        $view = $this->resolveView($view);
        
        return str_replace("{{content}}", $view, $layout);
    }
    
    public function renderError(string $view) : array|bool|string
    {
        $layout = $this->resolveLayout();
        $view = $this->resolveError($view);
        
        return str_replace("{{content}}", $view, $layout);
    }
    
    protected function resolveLayout() : bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIRECTORY . "/views/layouts/default.layout.php";
        
        return ob_get_clean();
    }
    
    protected function resolveView(string $view) : bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIRECTORY . "/views/{$view}.php";
        
        return ob_get_clean();
    }
    
    protected function resolveError(string $view) : bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIRECTORY . "/views/errors/{$view}.error.php";
        
        return ob_get_clean();
    }
    
}
