<?php

namespace Adm\FirstFramework\system\routes;

use Reflection;
use ReflectionClass;

class Router
{
    public function __construct()
    {
    }

    public function get($url, $controller = [])
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET')
            return;
        /*if ($url != $_SERVER['REQUEST_URI'])
            return;*/
        if (!isset($controller) || empty($controller))
            return;

        $this->validateRoute($url);

        $this->loadController($controller[0], $controller[1]);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            return;
    }

    private function validateRoute($url)
    {
        echo preg_replace("#{.*}#", "", $url);        
        
        if ($url != $_SERVER['REQUEST_URI'])
            return;
        
    }
    private function loadController($controllerName, $controllerMethod)
    {
        $reflection = new ReflectionClass($controllerName);
        $instance = $reflection->newInstance();

        if (!$reflection->hasMethod($controllerMethod)) {
            throw new \Exception("O método especificado não existe", 1);
        }

        $method = $reflection->getMethod($controllerMethod);
        $method->invoke($instance);
    }
}
