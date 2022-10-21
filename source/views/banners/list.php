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
        <?php foreach($banners as $banner){?>
            <li><?= $banner->getMessage()?></li>
        <?php }?>
    </ul>
</body>
</html>