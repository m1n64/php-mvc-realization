<?php

use App\Controllers\AboutController;
use App\Controllers\Api\ToDoListController;
use App\Controllers\MainPageController;
use App\Controllers\NotFoundController;
use App\Core\Router;

Router::get("/", [MainPageController::class, "index"]);
Router::get("/404", [NotFoundController::class]);
Router::get("/about", [AboutController::class]);
Router::post("/about/saveIp", [AboutController::class, "saveIp"]);

Router::get("/api/tasks/get", [ToDoListController::class, "get"]);
Router::post("/api/tasks/store", [ToDoListController::class, "store"]);
Router::post("/api/tasks/update", [ToDoListController::class, "update"]);
Router::post("/api/tasks/setStatus", [ToDoListController::class, "setStatus"]);
Router::delete("/api/tasks/delete", [ToDoListController::class, "delete"]);