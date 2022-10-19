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

        $pattern =  $this->replaceParamns($url); 

        if(! preg_match('#^'.$pattern.'$#', $_SERVER['REQUEST_URI']))
            return;
             

        $paramns = $this->findParamns($url, $pattern);        
        $values = $this->findValues($url, $pattern);

        print_r($paramns);        
        print_r($values);

        //$this->loadController($controller[0], $controller[1], $paramns);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
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

    private function validateRoute($pattern)
    {   
        return preg_match('#^'.$pattern.'$#', $_SERVER['REQUEST_URI']);      
    }

    private function findParamns($url)
    {
        preg_match_all("#{([A-Za-z0-9-]+)}#", $url, $matches);

        return $matches[1];
    }

    private function findValues($pattern){

        echo $pattern . '<br>';

        preg_match_all('#^'.$pattern.'$#', $_SERVER['REQUEST_URI'], $matches);

        return $matches;
    }

    private function replaceParamns($url)
    {
        return preg_replace("#{([A-Za-z0-9]+)}#", "([A-Za-z0-9-]+)", $url);
    }


}
