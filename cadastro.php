<?php
  $id= $_GET['id'];
  $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws
  .com user=banco_dados dbname=postgres password=professorbd");
  $query = "SELECT * FROM estoque.produtos WHERE id = $id";  
  $result = pg_exec($db_handle, $query);

  for ($row = 0; $row < pg_numrows($result); $row++) {
    $ID =  pg_result($result, $row, 'id');
    $nome = pg_result($result, $row, 'nome');
    $CATEGORIA = pg_result($result, $row, 'categoria');
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastrar</title>
</head>
<body>
    <header>
        <h1 class="topo"> Cadastramento </h1>
    </header>
    <div class="form-cadastro">
        <form action="inserir_cadastro.php" method="post">
            <div>
                <label for="ID">ID</label>
                <br>
                <input type="number" min="1" name="id" class="input" required  
                value="<?php echo $ID ?>"/>
            </div>
            <br>
            <div>
                <label for="Nome">Nome</label>
                <br>
                <input type="text" name="nome" class="input" required 
                value="<?php echo $name ?>"/>
            </div>
            <br>
            <div>
                <label for="categoria">Categoria:</label>
                <br>
                <input type="text" name="status" class="input" required 
                value="<?php echo $CATEGORIA ?>"/>
            </div>
            <br>
            <div>
                <button class="button" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>