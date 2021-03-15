<?php

namespace Arcadia;

class Session
{
    protected array $flashBag = [];
    
    public function __construct()
    {
        session_start();
        
        $this->boot();
    }
    
    protected function boot()
    {
        $this->flashBag = $_SESSION["flash"] ?? [];
        
        foreach ($this->flashBag as $key => &$value) {
            $value["remove"] = true;
        }
        
        $_SESSION["flash"] = $this->flashBag;
    }
    
    public function flash(string $key, ?string $message = null) : string
    {
        if (!is_null($message)) {
            $this->flashBag[$key]["value"] = $message;
        }
        
        return $this->flashBag[$key]["value"] ?? "";
    }
    
    public function __destruct()
    {
        foreach ($this->flashBag as $key) {
            if ($this->flashBag[$key]["remove"]) {
                unset($this->flashBag[$key]);
            }
        }
        
        $_SESSION["flash"] = $this->flashBag;
    }
}
