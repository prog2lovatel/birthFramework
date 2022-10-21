<?php

namespace BirthFramework\routes;

use Source\controllers\error\Error;
use BirthFramework\Container;
use BirthFramework\Singleton;

class Router implements Singleton
{
    private const CONTROLLER_NAME = 0;
    private const CONTROLLER_METHOD = 1;

    public static $instance;

    private $url;
    private $controller;
    private $method;
    private $paramns;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Router();
            self::$instance->controller = "";
            self::$instance->method = "";
            self::$instance->paramns = [];
        }

        return self::$instance;
    }

    public function get($url, $controller = [])
    {
        $this->url = $url;

        ### Verificar se é o Método GET ###
        if ($_SERVER['REQUEST_METHOD'] != 'GET')
            return;

        ### Construir Padrão de Comparação ###
        $pattern = $this->buildUrlCheckPattern();

        ### Testar o padrão com a request URI ###
        if (!preg_match($pattern, $_SERVER['PATH_INFO'], $matches))
            return;

        ### Extrair os parametros ###
        $this->controller = $controller[Router::CONTROLLER_NAME];
        $this->method = $controller[Router::CONTROLLER_METHOD];
        $this->paramns = $this->getParamns($matches);        
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
        if (!preg_match($pattern, $_SERVER['PATH_INFO'], $matches))
            return;

        ### Extrair os parametros ###
        $this->controller = $controller[Router::CONTROLLER_NAME];
        $this->method = $controller[Router::CONTROLLER_METHOD];
        $this->paramns = $this->getParamns($matches);   
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
        if (!preg_match($pattern, $_SERVER['PATH_INFO'], $matches))
            return;

        ### Extrair os parametros ###
        $this->controller = $controller[Router::CONTROLLER_NAME];
        $this->method = $controller[Router::CONTROLLER_METHOD];
        $this->paramns = $this->getParamns($matches);   
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
        if (!preg_match($pattern, $_SERVER['PATH_INFO'], $matches))
            return;

        ### Extrair os parametros ###
        $this->controller = $controller[Router::CONTROLLER_NAME];
        $this->method = $controller[Router::CONTROLLER_METHOD];
        $this->paramns = $this->getParamns($matches);   
    }

    public function notFound()
    {
        if(!empty($this->controller)){
            return;
        }
        
        $this->controller = Error::class;
        $this->method = "notFound";
    }

    public function exec() : Container
    {
        return new Container($this->controller, $this->method, $this->paramns);
    }

    private function buildUrlCheckPattern()
    {
        $patterns[0] = "#{([A-Za-z0-9]+)}#";
        $patterns[1] = "#{([A-Za-z0-9]+:any)}#";

        $replacements[0] = "([0-9]+)";
        $replacements[1] = "([A-Za-z0-9-]+)";

        return '#^' . preg_replace($patterns, $replacements, $this->url) . '$#';
    }

    private function findLabels()
    {
        preg_match_all("#{([A-Za-z0-9:]+)}#", $this->url, $matches);

        return $matches[1];
    }

    private function getParamns($matches)
    {
        $paramns = [];

        $labels = $this->findLabels();

        if ($labels != null) {

            foreach ($labels as $i => $label) {

                $label = preg_replace("#:any#", "", $label);

                $paramns[$label] = $matches[$i + 1];
            }
        }

        return $paramns;
    }
}
