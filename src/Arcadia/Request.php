<?php

namespace Arcadia;

/**
 * Class Request
 * @package Arcadia
 */
class Request
{
    public function serverPath() : string
    {
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        
        $position = strpos($path, "?");
        
        if (!$position) {
            return $path;
        }
        
        return substr($path, 0, $position);
    }
    
    public function method() : string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
    
}
