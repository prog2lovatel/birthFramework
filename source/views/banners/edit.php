<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Criar</title>
</head>
<body>
    <h1>Alteração de Banner</h1>

    <form action="">
        <label>Titulo:</label>
        <input type="text" name="titulo" value="<?= $banner->titulo?>">
        <button type="submit">Alterar</button>
    </form>
</body>
</html>