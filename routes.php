<?php

use Source\controllers\BannerController;
use Source\controllers\HomeController;

/* Neste arquivo são configuradas as rotas da sua aplicação */

$router->get('/', [HomeController::class, "index"]);
$router->get('/banner', [BannerController::class, "index"]);
$router->get('/banner/criar', [BannerController::class, "create"]);
$router->get('/banner/{id}', [BannerController::class, "edit"]);
$router->get('/banner/{id}/{titulo:any}', [BannerController::class, "show"]);
$router->get('/banner/store', [BannerController::class, "store"]);

$router->notFound();
