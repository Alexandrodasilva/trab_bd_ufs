<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");

    function atualizar(){
        $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $categoria = $_GET['categoria'];
        $categoria = explode(",", $categoria);
        $quantidade = $_GET['quantidade'];
        $valor_medio = $_GET['valor_medio'];
        $query = "UPDATE estoque.produto SET nome = '$nome', quantidade = '$quantidade', valor_medio = '$valor_medio' 
        WHERE id = '$id' RETURNING id";
        $result = pg_exec($db_handle, $query); 
        $id2 =  pg_result($result, 0, 'id');
        $query2 = "DELETE FROM estoque.possui WHERE id_produto = '$id2'";
        $result = pg_exec($db_handle, $query2);
        for ($i=0; $i<count($categoria); $i++){
            $query3 = "INSERT INTO estoque.possui(id_produto, id_categoria)  VALUES ('$id2', '$categoria[$i]');";
            $result3 = pg_exec($db_handle, $query3);
        }
        echo '<script>alert("Produto atualizado com sucesso!")</script>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./FrontEnd/styles/style.css">
    <title>Document</title>
</head>
<body>
    <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
    <?php atualizar()?>
    <br>
    <button class="button" onclick="voltar()">Voltar</button>
</body>
<script>
    function voltar(){
        window.location.href = "listagem.php"
    }
</script>
</html>