<?php

use Adm\FirstFramework\controllers\Banners;
use Adm\FirstFramework\system\routes\Router;

$router = new Router();

/* Routes de Banners */
//$router->get('/banner', [Banners::class, "index"]);

$router->get('/banner/criar', [Banners::class, "create"]);
$router->get('/banner/atualizar/{id}/teste', [Banners::class, "edit"]);

$router->get('/noticia/{id}', [Banners::class, "edit"]);
$router->get('/noticia/{id}/{titulo}', [Banners::class, "edit"]);
