<?php

namespace BirthFramework\response;

class JsonResponse extends Response
{
    public function __construct(array $content, $statusCode = 200)
    {
        parent::__construct($content, $statusCode);
    }

    protected function buildContent()
    {
        return json_encode($this->content);
    }
    
}
