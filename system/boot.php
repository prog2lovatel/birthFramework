<?php

use BirthFramework\Request;
use BirthFramework\routes\Router;

include __DIR__ . '/../config.php';

$request = Request::getInstance();

$router = Router::getInstance();

include __DIR__ . '/../routes.php';

$container = $router->exec();

$response = $container->exec();

$response->send();

exit();
