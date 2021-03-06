<?php

namespace Arcadia;

/**
 * Class Request
 * @package Arcadia
 */
class Request
{
    public const GET = "get";
    public const POST = "post";
    
    private array $inputs = [];
    
    public function __construct()
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
        
        $this->inputs = $sanitizedBody;
    }
    
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
    
    public function isGet() : bool
    {
        return $this->method() === self::GET;
    }
    
    public function isPost() : bool
    {
        return $this->method() === self::POST;
    }
    
    public function body() : array
    {
        return $this->inputs;
    }
    
    public function has(string $key) : bool
    {
        return isset($this->inputs[$key]);
    }
    
    public function inputs() : array
    {
        return $this->inputs;
    }
    
    public function input(string $key, mixed $value = null) : mixed
    {
        if ($this->has($key)) {
            return $this->inputs[$key];
        }
        
        return $value;
    }
}
