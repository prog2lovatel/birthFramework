<?php

use BirthFramework\response\HtmlResponse;

function view(string $path, array $data = [], int $status = 200) : HtmlResponse
{
    if(!file_exists(APP_PATH . "/source/views/" . $path)){
        
        throw new \InvalidArgumentException("Não foi possível encontrar a view: " .$path);
    }

    ob_start();

    try {

        extract($data);

    } catch (\Throwable $th) {

        throw new \InvalidArgumentException("A variável data deve ser um array.");
    }    

    include APP_PATH . "/source/views/" . $path;

    $content = ob_get_clean();    

    return new HtmlResponse($content, $status);
}