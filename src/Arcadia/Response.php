<?php


namespace Arcadia;


class Response
{
    public function status(int $code) : self
    {
        http_response_code($code);
        
        return $this;
    }
}
