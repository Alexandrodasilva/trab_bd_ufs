<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    if (isset($_GET['id'])){
        $id= $_GET['id'];
        $query = "SELECT * FROM estoque.categoria WHERE id = $id";  
        $result = pg_exec($db_handle, $query);
        for ($row = 0; $row < pg_numrows($result); $row++) {
            $nome = pg_result($result, $row, 'nome_categoria');
        }
    }else{
        $id = "";
        $nome = "";
    }
    function atualizar(){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $query = "UPDATE estoque.categoria SET nome = '$nome' WHERE id = '$id'";
        $result = pg_exec($db_handle, $query);  
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
    <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
    <header>
        <h2 class="topo"> Cadastramento de Categoria </h2>
    </header>
    <div class="form-cadastro">
        <input id="id" type="hidden" class="input" value="<?php echo $id?>" />
        <form method="post">
            <div>
                <label for="Nome">Nome</label>
                <br>
                <input id="nome" type="text" name="nome" class="input" required 
                value="<?php echo $nome?>"/>
            </div>
            <br>
        </form>
        <button class="button" onclick="atualizar()">Cadastrar
        </button>
        <button class = "button" onclick="window.location.href='listagem_categorias.php'">Voltar</button>
    </div>
    <script>
        function atualizar(){
            var id = document.getElementById('id').value
            var nome = document.getElementById('nome').value
            if (id != ""){
                window.location.href='atualiza_categoria.php?id='+id+'&nome='+nome;
            }else{
                window.location.href='cadastra_categoria.php?nome='+nome;
            }
        }
    </script>
</body>
</html>