<?php
use DI\ContainerBuilder;

require __DIR__ . '/../../../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../../config/di-config.php');
return $containerBuilder->build();