<?php
namespace App\Core\Middleware\Interfaces;


interface MiddlewareInterface
{
    public function execute() : void;
}