<?php

namespace Source\controllers;

use BirthFramework\Controller;
use BirthFramework\response\Response;
use BirthFramework\View;

class HomeController extends Controller
{
    public function index() : Response
    {
        return View::render("home.php");
    }
}
