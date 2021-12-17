<?php
function lista_produtos(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $query = "SELECT * FROM estoque.produto";  
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $id =  pg_result($result, $row, 'id');
        $nome = pg_result($result, $row, 'nome');
        $query = "SELECT c.nome_categoria FROM estoque.produto pr JOIN estoque.possui p ON (pr.id = p.id_produto) JOIN estoque.categoria c ON (p.id_categoria = c.id) WHERE pr.id = '$id';";
        $result2 = pg_exec($db_handle, $query);
        $categorias = "";
        $n = pg_numrows($result2)-1;
        for ($i = 0; $i < $n; $i++){
            $categorias .= pg_result($result2, $i, 'nome_categoria').', ';
        }
        $categorias .= pg_result($result2, $n, 'nome_categoria');
        $quantidade = pg_result($result, $row, 'quantidade');
        $valor_medio = pg_result($result, $row, 'valor_medio');

        echo '<a href = "detalhes_produto.php?id='.$id.'"><li class = "produto" href = "detalhes_produto.php"
         >Nome: '.$nome.'<br> Categorias: '.
         $categorias.'<br> Quantidade Disponível: '.$quantidade.'<br> Valor Médio: R$ '.$valor_medio.'<br><a href="cadastro.php?id='.$id.'
         "><br><button>Atualizar</button></a>&nbsp; &nbsp;<a href="remover.php?id='.$id.'
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
    <title>Lista de produtos</title>
</head>
<body>
    <header>
        <div id = "fundo" ><h1 id="logo" > &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
        <br>
        <form method="post" action="cadastro.php">
            <button class="button" type="submit">Cadastrar novo produto</button>
        </form>
        <br>
        <button class = "button" onclick="window.location.href = 'listagem_categorias.php'"> Categorias</button>
    </header>
    <div class="content"> 
        <h2 class="content-wap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lista de Produtos</h2>
        <ul id = "lista de produtos">
            <?php lista_produtos()?>
        </ul>
    </div>
    <script>

    </script>
</body>
</html>