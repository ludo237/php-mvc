<?php

namespace Arcadia;

/**
 * Class Controller
 * @package Arcadia
 */
abstract class Controller
{
    public function show(string $view, array $params = []) : bool|array|string
    {
        return Application::$instance->router->renderView($view, $params);
    }
}
