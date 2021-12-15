<?php
function lista_produtos(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $query = "SELECT * FROM estoque.produtos";  
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $id =  pg_result($result, $row, 'id');
        $nome = pg_result($result, $row, 'nome');
        $categoria = pg_result($result, $row, 'categoria');

        echo '<a><li class = "produto" href = "detalhes_produto.php"
         >Id :'.$id.'<br> Nome: '.$nome.'<br> Categoria : '.
         $categoria.'<br><a href="cadastro.php?id='.$id.'
         "><button>atualizar</button></a><a href="remover.php?id='.$id.'
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
    <link rel="stylesheet" href="style.css">
    <title>Lista de produtos</title>
</head>
<body>
    <header>
        <h1> LOJA </h1>
        <form method="post" action="cadastro.php">
            <button class="button" type="submit">Cadastrar novo produto</button>
        </form>
    </header>
    <div class="content"> 
        <h1 class="content-wap">Lista de produtos</h1>
        <ul id = "lista de produtos">
            <?php lista_produtos()?>
        </ul>
    </div>
    <script>

    </script>
</body>
</html>