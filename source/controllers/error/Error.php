<?php 
namespace Source\controllers\error;

class Error
{
    function notFound(){
        
        return view('errors/notFound.php', ['mensagem' => "Página não encontrada."], 404);
    }
}
