<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $id= $_GET['id'];
    $query = "SELECT * FROM estoque.produtos WHERE id = $id";  
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $nome = pg_result($result, $row, 'nome');
        $categoria = pg_result($result, $row, 'categoria');
    }
    function atulizar(){
        //code
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./FrontEnd/styles/cadastro.css">
    <title>Cadastrar</title>
</head>
<body>
    <header>
        <h1 class="topo"> Cadastramento </h1>
    </header>
    <div class="form-cadastro">
        <form action="inserir_cadastro.php" method="post">
            <div>
                <label for="Nome">Nome</label>
                <br>
                <input type="text" name="nome" class="input" required 
                value="<?php echo $nome?>"/>
            </div>
            <br>
           <!-- <div>
                <label for="especificacao">Especificação:</label>
                <br>
                <textarea class="input-especifico" id="msg"></textarea>
            </div>
            <br>
            <div>
                <label for="Status">Status:</label>
                <br>
                <input type="text"  class="input" id="msg">
            </div>
            <br> -->
            <div>
                <label for="categoria">Categoria:</label>
                <br>
                <input type="text" name="status" class="input" required 
                value="<?php echo $categoria ?>"/>
            </div>
            <br>
            <div>
                <button class="button" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>