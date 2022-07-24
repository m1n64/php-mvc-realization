<?php
ini_set('display_errors', 1);

require __DIR__."/../../vendor/autoload.php";

use App\Core\Database\Migration;
use DevCoder\DotEnv;

(new DotEnv(__DIR__."/../../.env"))->load();

echo Migration::create("todo_list", [
    "task_name"=>"VARCHAR(255)",
    "task_text"=>"TEXT",
    "is_done"=>"INT DEFAULT 0",
]);