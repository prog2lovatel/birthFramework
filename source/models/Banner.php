<?php

namespace Source\models;

class Banner
{
    public $id;
    public $titulo;

    public function __construct($id, $titulo)
    {
        $this->id = $id;
        $this->titulo = $titulo;
    }

    public function getMessage()
    {
        return "Olá sou o meu titulo é: " . $this->titulo;
    }
}
