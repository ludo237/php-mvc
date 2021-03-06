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
    protected string $layout;
    
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
     * @param callable|string|array $value
     */
    private function addRouteToList(string $method, string $path, callable|string|array $value) : void
    {
        $this->routes[$method][$path] = $value;
    }
    
    /**
     * @param string $path
     * @param \Closure|array|string $callback
     *
     * @return $this
     */
    public function get(string $path, Closure|array|string $callback) : self
    {
        $this->addRouteToList("get", $path, $callback);
        
        return $this;
    }
    
    /**
     * @param string $path
     * @param \Closure|array|string $callback
     *
     * @return $this
     */
    public function post(string $path, Closure|array|string $callback) : self
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
        
        // Direct view render
        if (is_string($callback) && !class_exists($callback)) {
            return $this->renderView($callback);
        }
        
        // If it's not a view we assume that it's an invokable controller
        // Invokable controllers are the only way I want to support controllers because it
        // forces the developer to DRY controllers as much as possibile
        $controller = new $callback();
        $this->layout = $controller->getLayout();
        
        return call_user_func($controller, $this->request);
    }
    
    public function renderView(string $view, array $parameters = []) : array|bool|string
    {
        $layout = $this->resolveLayout();
        $view = $this->resolveView($view, $parameters);
        
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
        $layout ??= "default";
        
        ob_start();
        include_once Application::$ROOT_DIRECTORY . "/views/layouts/{$layout}.layout.php";
        
        return ob_get_clean();
    }
    
    protected function resolveView(string $view, array $parameters = []) : bool|string
    {
        // This sucks but it works now I need to study more about the rendering engine
        
        // Auto inject errors on every views
        $errors ??= [];
        $old ??= [];
        
        foreach ($parameters as $key => $value) {
            $$key = $value;
        }
        
        
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
