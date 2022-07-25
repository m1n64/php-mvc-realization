<?php
ini_set('display_errors', 1);

require __DIR__."/../../vendor/autoload.php";

use App\Core\Database\Migration;
use DevCoder\DotEnv;

(new DotEnv(__DIR__."/../../.env"))->load();

echo Migration::create("users_ip", [
    "ip"=>"VARCHAR(255) NOT NULL",
    "country"=>"varchar(255)",
    "city"=>"varchar(255)"
]);