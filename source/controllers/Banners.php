<?php

namespace Source\controllers;

use BirthFramework\Request;
use BirthFramework\response\HtmlResponse;
use BirthFramework\response\JsonResponse;
use BirthFramework\View;
use Source\models\Banner;

class Banners
{
    public function index()
    {        
        $banners[] = new Banner(1, "Banner 1");
        $banners[] = new Banner(2, "Banner 2");
        $banners[] = new Banner(3, "Banner 3");

        return View::render('restrict/banners/list.php', ['banners' => $banners]);
    }

    public function create()
    {   
        return View::render('restrict/banners/create.php');
    }

    public function store()
    {   
        $request = Request::getInstance();
        
        $banner = [
            'titulo' => $request->getParamn('titulo')            
        ];

        return new JsonResponse($banner, 201);
    }

    public function edit(int $id)
    {          
        $banner = new Banner(1, "Banner 1");
        
        return View::render('restrict/banners/edit.php', ['banner' => $banner]);
    }

    public function show(int $id)
    {          
        return new HtmlResponse("Teste show id: ". $id);
    }
}
