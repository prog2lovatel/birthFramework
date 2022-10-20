<?php 
namespace Adm\FirstFramework\controllers\error;

class Error
{
    function notFound(){
        
        http_response_code(404);

        echo "Página não encontrada.";

        die();
    }
}
