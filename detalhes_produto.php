<?php
function detalha_produto(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $id = $_GET['id'];
    $query = "SELECT * FROM estoque.produtos WHERE id = $id";
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $nome = pg_result($result, $row, 'nome');
        $categoria = pg_result($result, $row, 'categoria');
        $quantidade = pg_result($result, $row, 'quantidade');
        $valor_medio = pg_result($result, $row, 'valor_medio');
        echo '<div id = "detalhes_produto"> Id :'.$id.' <br> Nome: '.$nome.' <br> Categoria : '.$categoria.'<br> Quantidade Disponível: '.$quantidade.'<br> Valor Médio: R$ '.$valor_medio.'</div>';
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
    <title>Produto</title>
</head>
<body>
    <div class="content"> 
        <h1 class="content-wap">Produto</h1>
        <a href="listagem.php" ></>
        <?php  detalha_produto()?>
    </div>
    <script>

    </script>
</body>
</html>