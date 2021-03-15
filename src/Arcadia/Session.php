<?php

namespace Arcadia;

class Session
{
    protected array $flashBag = [];
    protected array $sessionBag = [];
    
    public function __construct()
    {
        session_start();
        
        $this->boot();
    }
    
    protected function boot()
    {
        $this->sessionBag["flash"] = $_SESSION["flash"] ?? [];
        
        foreach ($this->sessionBag["flash"] as $key => &$value) {
            $value["remove"] = true;
        }
        
        $_SESSION["flash"] = $this->sessionBag["flash"];
    }
    
    public function flash(string $key, ?string $message = null) : string
    {
        if (!is_null($message)) {
            $this->sessionBag["flash"][$key]["value"] = $message;
        }
        
        return $this->sessionBag["flash"][$key]["value"] ?? "";
    }
    
    public function has(string $key) : bool
    {
        return isset($this->sessionBag[$key]);
    }
    
    public function set(string $key, mixed $value)
    {
        $this->sessionBag[$key] = $value;
        
        $_SESSION[$key] = $value;
    }
    
    public function get(string $key) : mixed
    {
        return $this->sessionBag[$key] ?? null;
    }
    
    public function remove(string $key) : void
    {
        if ($this->has($key)) {
            unset($this->sessionBag[$key]);
        }
        
        $_SESSION = $this->sessionBag;
    }
    
    public function __destruct()
    {
        foreach ($this->sessionBag["flash"] as $key) {
            if ($this->sessionBag["flash"][$key]["remove"]) {
                unset($this->sessionBag["flash"][$key]);
            }
        }
        
        $_SESSION["flash"] = $this->sessionBag["flash"];
    }
}
