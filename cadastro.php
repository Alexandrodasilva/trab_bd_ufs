<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    $id= $_GET['id'];
    $query = "SELECT * FROM estoque.produtos WHERE id = $id";  
    $result = pg_exec($db_handle, $query);
    for ($row = 0; $row < pg_numrows($result); $row++) {
        $nome = pg_result($result, $row, 'nome');
        $categoria = pg_result($result, $row, 'categoria');
        $quantidade = pg_result($result, $row, 'quantidade');
        $valor_medio = pg_result($result, $row, 'valor_medio');
    }
    function atualizar(){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $quantidade = $_POST['quantidade'];
        $valor_medio = $_POST['valor_medio'];
        $query = "UPDATE estoque.produtos SET nome = '$nome', categoria = '$categoria', quantidade = '$quantidade', valor_medio = '$valor_medio' 
        WHERE id = '$id'";  
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
                <label for="quantidade">quantidade:</label>
                <br>
                <input type="number" name="quantidade" class="input" required 
                value="<?php echo $quantidade ?>"/>
            </div>
            <br>
            <div>
                <label for="valor_medio">valor medio:</label>
                <br>
                <input type="text" name="valor_medio" class="input" required 
                value="<?php echo $valor_medio ?>"/>
            </div>
            <br>
            <div>
                <button class="button" type="submit">Cadastrar
                <?php atualizar()?>
                </button>
            </div>
        </form>
    </div>
</body>
</html>