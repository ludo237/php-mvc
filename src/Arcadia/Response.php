<?php


namespace Arcadia;


class Response
{
    public const HTTP_UNPROCESSABLE_ENTITY = 422;
    
    public function status(int $code) : self
    {
        http_response_code($code);
        
        return $this;
    }
}
