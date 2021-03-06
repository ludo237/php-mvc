<?php


namespace Arcadia\Support;


class Environment
{
    public static function load(string $key, mixed $default = null) : string
    {
        return $_ENV[$key] ?? $default;
    }
}
