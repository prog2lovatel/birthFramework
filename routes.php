<?php

use Source\controllers\Banners;

/* Routes de Banners */
$router->get('/banner', [Banners::class, "index"]);
$router->get('/banner/criar', [Banners::class, "create"]);
$router->get('/banner/{id}', [Banners::class, "edit"]);
$router->get('/banner/{id}/{titulo:any}', [Banners::class, "show"]);
$router->get('/banner/store', [Banners::class, "store"]);

$router->notFound();
