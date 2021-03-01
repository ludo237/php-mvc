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
    
    public function body()
    {
        $sanitizedBody = [];
        
        // TODO Improve this shit fest
        if ($this->method() === "get") {
            foreach ($_GET as $key => $value) {
                $sanitizedBody[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                
            }
        }
        
        if ($this->method() === "post") {
            foreach ($_POST as $key => $value) {
                $sanitizedBody[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        
        return $sanitizedBody;
    }
}
