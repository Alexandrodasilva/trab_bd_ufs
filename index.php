<?php
$db_handle = pg_connect("host=database-1.cwnslzm6sfas.us-east-1.rds.amazonaws.com user=postgres password=atila1998");

function lista_produtos(){
    $db_handle = pg_connect("host=database-1.cwnslzm6sfas.us-east-1.rds.amazonaws.com user=postgres password=atila1998");
    $query = "SELECT * FROM estoque.produtos";
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $id =  pg_result($result, $row, 'id');
        $nome = pg_result($result, $row, 'nome');
        $categoria = pg_result($result, $row, 'categoria');
        echo '<a href = "detalhes_produto.php?id='.$id.'"><li class = "produto" href = "detalhes_produto.php" >Id :'.$id.'<br> Nome: '.$nome.'<br> Categoria : '.$categoria.'</li></a>';
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