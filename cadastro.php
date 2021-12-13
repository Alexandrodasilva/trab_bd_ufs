<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastrar</title>
</head>
<body>
    <header>
        <h1 class="topo"> Cadastramento </h1>
    </header>
    <div class="form-cadastro">
        <form>
            <div>
                <label for="Nome">Nome</label>
                <br>
                <input type="text" class="input"id="nome" />
            </div>
            <br>
            <div>
                <label for="ID">ID</label>
                <br>
                <input type="number" min="0" class="input" id="email" />
            </div>
            <br>
            <div>
                <label for="especificacao">Especificação:</label>
                <br>
                <textarea class="input-especifico" id="msg"></textarea>
            </div>
            <br>
            <div>
                <label for="Status">Status:</label>
                <br>
                <input type="text"  class="input" id="msg">
            </div>
            <br>
            <div>
                <button class="button" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>