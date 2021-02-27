<?php

namespace Arcadia;

use JetBrains\PhpStorm\Pure;

/**
 * Class Request
 * @package Arcadia
 */
class Request
{
    #[Pure] public function serverPath() : string
    {
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        
        $position = strpos($path, "?");
        
        if (!$position) {
            return $path;
        }
        
        return substr($path, 0, $position);
    }
    
    #[Pure] public function method() : string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
    
}
