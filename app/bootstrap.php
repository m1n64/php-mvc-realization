<?php

use App\Core\Router;
use DevCoder\DotEnv;

(new DotEnv(__DIR__."/../.env"))->load();

Router::start();
