<?php

namespace BirthFramework;

use BirthFramework\response\HtmlResponse;

class View
{
    public static function render(string $path, array $data = [], int $status = 200): HtmlResponse
    {
        if (!file_exists(APP_PATH . "/source/views/" . $path)) {

            throw new \InvalidArgumentException("Não foi possível encontrar a view: " . $path, 1);
        }

        ob_start();

        try {

            extract($data);
        } catch (\Throwable $th) {

            throw new \InvalidArgumentException("A variável data deve ser um array.", 1);
        }

        include APP_PATH . "/source/views/" . $path;

        $content = ob_get_clean();

        return new HtmlResponse($content, $status);
    }
}
