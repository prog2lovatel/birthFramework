<?php

namespace Source\controllers;

use BirthFramework\response\HtmlResponse;
use BirthFramework\response\JsonResponse;

class Banners
{
    public function index()
    {
        echo 'Teste';
    }

    public function create()
    {
        return new HtmlResponse("<h1>Página de Criação de Banners</h1>");
    }

    public function edit(int $id)
    {          
        return new JsonResponse(['id' => $id, 'titulo' => "Willian"], 201);
    }
}
