<?php

namespace BirthFramework;

use ReflectionClass;
use ReflectionMethod;

class Container
{
    private $controller;
    private $method;
    private $paramns;

    public function __construct(string $controller, string $method, array $paramns = [])
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->paramns = $paramns;
    }

    public function exec()
    {
        $reflaction = $this->createReflactionClass();

        $instance = $reflaction->newInstance();

        $reflactionMethod = $this->getReflactionMethod($reflaction);

        $args = $this->getReflectionMethodArgs($reflactionMethod);

        $response = $reflactionMethod->invokeArgs($instance, $args);

        if ($response != null) {

            $response->send();
        }

        exit();
    }

    private function createReflactionClass(): ReflectionClass
    {
        try {

            return new ReflectionClass($this->controller);
        } catch (\Throwable $e) {

            throw new \InvalidArgumentException("O controlador " . $this->controller . " não existe.");
        }
    }

    private function getReflactionMethod($reflection): ReflectionMethod
    {
        if (!$reflection->hasMethod($this->method)) {

            throw new \InvalidArgumentException("O método " . $this->method . " não existe.", 1);
        }

        return $reflection->getMethod($this->method);
    }

    private function getReflectionMethodArgs($reflectionMethod): array
    {
        $parameters = $reflectionMethod->getParameters();

        $args = [];

        foreach ($parameters as $parameter) {

            if (!isset($this->paramns[$parameter->getName()]) || empty($this->paramns[$parameter->getName()])) {

                throw new \InvalidArgumentException("O parametro " . $parameter->getName() . " não foi informado.", 1);
            }

            $args[] = $this->paramns[$parameter->getName()];
        }

        return $args;
    }
}
