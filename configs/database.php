<?php

use Arcadia\Support\Environment;

return [
    "driver" => Environment::load("DATABASE_DRIVER", "pgsql"),
    "host" => Environment::load("DATABASE_HOST", "database"),
    "port" => (int)Environment::load("DATABASE_PORT", 5432),
    "database" => Environment::load("DATABASE_NAME", "default"),
    "user" => Environment::load("DATABASE_USER", "default"),
    "password" => Environment::load("DATABASE_PASSWORD", "supersecret"),
    "options" => [],
];
