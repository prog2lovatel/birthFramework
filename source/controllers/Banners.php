<?php

namespace Source\controllers;

use BirthFramework\response\HtmlResponse;
use Source\models\Banner;

class Banners
{
    public function index()
    {
        $banners[] = new Banner(1, "Banner 1");
        $banners[] = new Banner(2, "Banner 2");
        $banners[] = new Banner(3, "Banner 3");

        return view('restrict/banners/list.php', ['banners' => $banners]);
    }

    public function create()
    {   
        return view('restrict/banners/create.php');
    }

    public function edit(int $id)
    {          
        $banner = new Banner(1, "Banner 1");
        
        return view('restrict/banners/edit.php', ['banner' => $banner]);
    }

    public function show(int $id)
    {          
        return new HtmlResponse("Teste show id: ". $id);
    }
}
