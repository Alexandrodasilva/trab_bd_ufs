<?php
function detalha_produto(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $id = $_GET['id'];
    $query = "SELECT * FROM estoque.produto WHERE id = $id";
    $result = pg_exec($db_handle, $query);
    $query = "SELECT c.nome_categoria FROM estoque.produto pr JOIN estoque.possui p ON (pr.id = p.id_produto) JOIN estoque.categoria c ON (p.id_categoria = c.id) WHERE pr.id = '$id';";
    $result2 = pg_exec($db_handle, $query);
    $categorias = "";
    $n = pg_numrows($result2)-1;
    for ($i = 0; $i < $n; $i++){
        $categorias .= pg_result($result2, $i, 'nome_categoria').', ';
    }
    $categorias .= pg_result($result2, $n, 'nome_categoria');
    $nome = pg_result($result, 0, 'nome');
    $quantidade = pg_result($result, 0, 'quantidade');
    $valor_medio = pg_result($result, 0, 'valor_medio');
    echo '<div id = "detalhes_produto"> Id :'.$id.' <br> Nome: '.$nome.' <br> Categoria : '.$categorias.'<br> Quantidade Disponível: '.$quantidade.'<br> Valor Médio: R$ '.$valor_medio.'</div>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./FrontEnd/styles/style.css">
    <title>Produto</title>
</head>
<body>
    <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
    <div class="content"> 
        <h1 class="content-wap">Produto</h1>
        <a href="listagem.php" ></>
        <?php  detalha_produto()?>
    </div>
    <script>

    </script>
</body>
</html>