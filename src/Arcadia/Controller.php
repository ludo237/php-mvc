<?php

namespace Arcadia;

/**
 * Class Controller
 * @package Arcadia
 */
abstract class Controller
{
    protected string $layout = "default";
    
    /**
     * @param string $view
     * @param array $params
     *
     * @return bool|array|string
     */
    public function show(string $view, array $params = []) : bool|array|string
    {
        return Application::$instance->router->renderView($view, $params);
    }
    
    public function setLayout(string $layout) : self
    {
        $this->layout = $layout;
        
        return $this;
    }
    
    public
    function getLayout() : string
    {
        return $this->layout;
    }
}
