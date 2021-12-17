<?php
function detalha_produto(){
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $id = $_GET['id'];
    $query = "SELECT * FROM estoque.categoria WHERE id = $id";
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $nome = pg_result($result, $row, 'nome_categoria');
        echo '<div id = "detalhes_produto"> Id :'.$id.' <br> Categoria: '.$nome.'</div>';
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
    <title>Detalhes Categoria</title>
</head>
<body>
    <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
    <div class="content"> 
        <h1 class="content-wap">Categoria</h1>
        <a href="listagem.php" ></>
        <?php  detalha_produto()?>
    </div>
    <script>

    </script>
</body>
</html>