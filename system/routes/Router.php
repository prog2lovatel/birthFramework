<?php

namespace BirthFramework\routes;

use Adm\FirstFramework\controllers\error\Error;
use BirthFramework\Container;

class Router
{
    private const CONTROLLER_NAME = 0;
    private const CONTROLLER_METHOD = 1;

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

        ### Cria um container para execução da Requisição ###
        $container = new Container($controller[Router::CONTROLLER_NAME], $controller[Router::CONTROLLER_METHOD], $paramns);

        $container->exec();
    }

    public function post($url, $controller = [])
    {
        $this->url = $url;

        ### Verificar se é o Método POST ###
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            return;

        ### Construir Padrão de Comparação ###
        $pattern = $this->buildUrlCheckPattern();

        ### Testar o padrão com a request URI ###
        if (!preg_match($pattern, $_SERVER['REQUEST_URI'], $matches))
            return;

        ### Extrair os parametros ###
        $paramns = $this->getParamns($matches);

        ### Cria um container para execução da Requisição ###
        $container = new Container($controller[Router::CONTROLLER_NAME], $controller[Router::CONTROLLER_METHOD], $paramns);

        $container->exec();
    }

    public function put($url, $controller = [])
    {
        $this->url = $url;

        ### Verificar se é o Método PUT ###
        if ($_SERVER['REQUEST_METHOD'] != 'PUT')
            return;

        ### Construir Padrão de Comparação ###
        $pattern = $this->buildUrlCheckPattern();

        ### Testar o padrão com a request URI ###
        if (!preg_match($pattern, $_SERVER['REQUEST_URI'], $matches))
            return;

        ### Extrair os parametros ###
        $paramns = $this->getParamns($matches);

        ### Cria um container para execução da Requisição ###
        $container = new Container($controller[Router::CONTROLLER_NAME], $controller[Router::CONTROLLER_METHOD], $paramns);

        $container->exec();
    }

    public function delete($url, $controller = [])
    {
        $this->url = $url;

        ### Verificar se é o Método DELETE ###
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE')
            return;

        ### Construir Padrão de Comparação ###
        $pattern = $this->buildUrlCheckPattern();

        ### Testar o padrão com a request URI ###
        if (!preg_match($pattern, $_SERVER['REQUEST_URI'], $matches))
            return;

        ### Extrair os parametros ###
        $paramns = $this->getParamns($matches);

        ### Cria um container para execução da Requisição ###
        $container = new Container($controller[Router::CONTROLLER_NAME], $controller[Router::CONTROLLER_METHOD], $paramns);

        $container->exec();
    }

    public function notFound()
    {
        $container = new Container(Error::class, "notFound");
        
        $container->exec();
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
    
}
