<?php
use function DI\create;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        return new Environment($loader);
    },
];