<?php

use App\Core\Router;
use DevCoder\DotEnv;

(new DotEnv(__DIR__."/../.env"))->load();

if (getenv("DEBUG_MODE")) {
    require "app/Core/debug/debug.phar";
}

Router::start();
