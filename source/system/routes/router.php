<?php

namespace Adm\FirstFramework\system\routes;

use Reflection;
use ReflectionClass;

class Router
{
    private $url;

    public function get($url, $controller = [])
    {
        $this->url = $url;

        ### Verificar se é o Método GET ###
        if ($_SERVER['REQUEST_METHOD'] != 'GET')
            return;

        ### Construir Padrão de Comparação ###
        $pattern = $this->buildUrlCheckPattern();

        ### Testar o padrão com a request URI ###
        if (!preg_match($pattern, $_SERVER['REQUEST_URI'], $matches))
            return;

        ### Extrair os parametros ###
        $paramns = $this->getParamns($matches);

        ### Invocar o Controlador
        $this->invokeController($controller[0], $controller[1], $paramns);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            return;
    }

    private function buildUrlCheckPattern()
    {
        return '#^' . preg_replace("#{([A-Za-z0-9]+)}#", "([A-Za-z0-9-]+)", $this->url) . '$#';
    }

    private function findLabels()
    {
        preg_match_all("#{([A-Za-z0-9-]+)}#", $this->url, $matches);

        return $matches[1];
    }

    private function getParamns($matches)
    {
        $paramns = [];

        $labels = $this->findLabels();

        if ($labels != null) {

            foreach ($labels as $i => $label) {

                $paramns[$label] = $matches[$i + 1];
            }
        }

        return $paramns;
    }

    private function invokeController($controllerName, $controllerMethod, $paramns)
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
