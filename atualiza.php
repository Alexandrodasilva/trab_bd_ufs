<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");

    function atualizar(){
        $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $categoria = $_GET['categoria'];
        $quantidade = $_GET['quantidade'];
        $valor_medio = $_GET['valor_medio'];
        $query = "UPDATE estoque.produto SET nome = '$nome', categoria = '$categoria', quantidade = '$quantidade', valor_medio = '$valor_medio' 
        WHERE id = '$id'";
        $result = pg_exec($db_handle, $query); 
        echo "Produto atualizado com sucesso!";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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