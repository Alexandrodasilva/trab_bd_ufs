<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");

    function atualizar(){
        $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
        $nome = $_GET['nome'];
        $query = "INSERT INTO estoque.categoria(nome_categoria) VALUES ('$nome') RETURNING id;";
        $result = pg_exec($db_handle, $query); 
        $id =  pg_result($result, 0, 'id');
        echo '<script>alert("Categoria cadastrada com sucesso!")</script>';
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
        window.location.href = "listagem_categorias.php"
    }
</script>
</html>