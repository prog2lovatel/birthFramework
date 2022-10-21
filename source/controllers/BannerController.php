<?php

namespace Source\controllers;

use BirthFramework\Controller;
use BirthFramework\response\HtmlResponse;
use BirthFramework\response\JsonResponse;
use BirthFramework\response\Response;
use BirthFramework\View;
use Source\models\Banner;

class BannerController extends Controller
{
    public function index() : Response
    {        
        $banners[] = new Banner(1, "Banner 1");
        $banners[] = new Banner(2, "Banner 2");
        $banners[] = new Banner(3, "Banner 3");

        return View::render('banners/list.php', ['banners' => $banners]);
    }

    public function create() : Response
    {   
        return View::render('banners/create.php');
    }

    public function store() : Response
    {          
        $banner = $this->request->all();

        return new JsonResponse($banner, 201);
    }

    public function edit(int $id) : Response
    {          
        $banner = new Banner($id, "Banner 1");
        
        return View::render('banners/edit.php', ['banner' => $banner]);
    }

    public function show(int $id) : Response
    {          
        return new HtmlResponse("Teste show id: ". $id);
    }
}
