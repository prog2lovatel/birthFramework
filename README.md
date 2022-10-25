# Birth Framework

Este é um micro framework de testes para estudo do protocolo http e arquitetura de softwares.

## Instalação

Para utilizar este framework você deve seguir estes passos:

```sh
git clone https://github.com/prog2lovatel/birthFramework.git
cd birthFramework
composer install
```

Para executar este framework você deve iniciar um servidor php local:

```sh
php -S localhost:8000
```

Agora é só acessar o link: http://localhost:8000

## Rotas

A configuração das rotas é feita pelo arquivo **routes.php**. Logo abaixo é mostrado o arquivo preenchido com rotas de exemplo. 

```php
<?php

use Source\controllers\BannerController;
use Source\controllers\HomeController;

$router->get('/', [HomeController::class, "index"]);
$router->get('/banner', [BannerController::class, "index"]);
$router->get('/banner/criar', [BannerController::class, "create"]);
$router->get('/banner/{id}', [BannerController::class, "edit"]);
$router->get('/banner/{id}/{titulo:any}', [BannerController::class, "show"]);
$router->get('/banner/store', [BannerController::class, "store"]);

$router->notFound();
```
O objeto **$router** possui 4 métodos para declaração das rotas, sendo eles: 
- **$route->get(string $url, array $controller = [])**;
- **$route->post(string $url, array $controller = [])**;
- **$route->put(string $url, array $controller = [])**;
- **$route->delete(string $url, array $controller = [])**;

Onde **$url** representa o segmento da uri que deve ser apontado para o método do controlador especificado. Já o array **$controller** é onde são declarados respectivamente o nome do controlador que será instanciado pela rota e o nome do método do controlador que será executado.

## Controladores

Os controladores devem ser criados dentro da pasta **source/controllers**. Logo abaixo é mostrado um codigo de exemplo de um controlador.

```php
<?php

namespace Source\controllers;

use BirthFramework\Controller;
use BirthFramework\response\HtmlResponse;
use BirthFramework\response\JsonResponse;
use BirthFramework\response\Response;
use BirthFramework\View;
use Source\models\Banner;

class BannerController extends Controller
{
    public function index() : Response
    {        
        $banners[] = new Banner(1, "Banner 1");
        $banners[] = new Banner(2, "Banner 2");
        $banners[] = new Banner(3, "Banner 3");

        return View::render('banners/list.php', ['banners' => $banners]);
    }
    
    public function create() : Response
    {   
        return View::render('banners/create.php');
    }
    
    public function store() : Response
    {          
        $banner = $this->request->all();

        return new JsonResponse($banner, 201);
    }
    
}
```
Todos os controladores devem extender da classe **Controller**, pois com a propriedade **$this->request** é possível ter acesso aos dados da requisição. Além disso todos os métodos dos controladores devem ter o tipo de retorno **Response**, porque assim o conteiner de execução consegue renderizar a resposta corretamente para o navegador.

##Views

As Views devem ser criados dentro da pasta **source/views**. Logo abaixo é mostrado um codigo de exemplo de uma view.

```php
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Banners</title>
</head>

<body>
    <h1>Lista de Banners</h1>
    
    <ul>
        <?php foreach ($banners as $banner) { ?>
            <li><?= $banner->getMessage() ?></li>
        <?php } ?>
    </ul>
</body>

</html>
```
As views são carregadas através do método estático **View::render(string $path, array $data = [], int $status = 200)** que retorna um objeto do tipo **HtmlResponse** que pode ser retornado pela classe controladora. O parametro **$path** representa o nome do arquivo da view que será carregada, já o parametro **$data** é um array que representa os dados que serão utilizados dentro do arquivo da view. A sintaxe da view é composta por tags html e utilização de instruções php.

## Modelos

Os Modelos devem ser criados dentro da pasta **source/models**. Logo abaixo é mostrado um codigo de exemplo de um modelo.

```php
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

```

Os modelos são classes que representam os dados eles podem ter a sua regra de negocio. Este framework é bem flexivel com relação a isto.

Em atualizações futuras será implementada a comunicação com banco de dados, autenticação e upload de arquivos.
