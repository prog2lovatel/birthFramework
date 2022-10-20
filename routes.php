<?php

use BirthFramework\routes\Router;
use Source\controllers\Banners;

$router = new Router();

/* Routes de Banners */
$router->get('/banner', [Banners::class, "index"]);
$router->get('/banner/criar', [Banners::class, "create"]);
$router->get('/banner/{id}', [Banners::class, "edit"]);
$router->get('/banner/{id}/{titulo:any}', [Banners::class, "show"]);

$router->notFound();
