<?php
function lista_produtos(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $query = "SELECT * FROM estoque.categoria";  
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $id =  pg_result($result, $row, 'id');
        $nome = pg_result($result, $row, 'nome_categoria');

        echo '<a href = "detalhes_categoria.php?id='.$id.'"><li class = "produto" href = "detalhes_produto.php"
         >Categoria : '.$nome.'<br><a href="cadastro_categoria.php?id='.$id.'
         "><br><button>Atualizar</button></a>&nbsp; &nbsp;<a href="remove_categoria.php?id='.$id.'
         "><button>Remover</button></a></li></a>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./FrontEnd/styles/style.css">
    <title>Lista de Categorias</title>
</head>
<body>
    <header>
        <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
        <br>
        <form method="post" action="cadastro_categoria.php">
            <button class="button" type="submit">Cadastrar nova categoria</button>
        </form>
        <br>
        <button class = "button" onclick="window.location.href = 'listagem.php'">Produtos</button>
    </header>
    <div class="content"> 
        <h2 class="content-wap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lista de Categorias</h2>
        <ul id = "lista de produtos">
            <?php lista_produtos()?>
        </ul>
    </div>
    <script>

    </script>
</body>
</html>