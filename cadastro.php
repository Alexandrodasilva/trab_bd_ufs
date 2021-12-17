<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
    if (isset($_GET['id'])){
        $id= $_GET['id'];
        $query = "SELECT * FROM estoque.produto WHERE id = '$id';";  
        $result = pg_exec($db_handle, $query);
        for ($row = 0; $row < pg_numrows($result); $row++) {
            $nome = pg_result($result, $row, 'nome');
            $query = "SELECT id_categoria FROM estoque.produto pr JOIN estoque.possui p ON(pr.id = p.id_produto) WHERE pr.id = '$id';";
            $result2 = pg_exec($db_handle, $query);
            $categoria = "";
            $n = pg_numrows($result2)-1;
            for ($i = 0; $i < $n; $i++){
                $categoria .= pg_result($result2, $i, 'id_categoria').',';
            }
            $categoria .= pg_result($result2, $n, 'id_categoria');
            $quantidade = pg_result($result, $row, 'quantidade');
            $valor_medio = pg_result($result, $row, 'valor_medio');
        }
    }else{
        $id = "";
        $nome = "";
        $categoria = "";
        $quantidade = "";
        $valor_medio = "";

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
        header{
            font-family: 'Roboto', sans-serif;
            color: white;
        }
    </style>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./FrontEnd/styles/cadastro.css">
    <title>Cadastrar</title>
</head>
<body>
    <div id = "fundo" ><h1> &nbsp;&nbsp;&nbsp;MercadoBay </h1></div>
    <header>
        <br>
        <h2 class="topo"> Cadastramento de Produto </h2>
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
            <div>
                <label for="categoria">Categoria:</label>
                <br>
                <input id = "categoria" type="text" name="status" class="input" required 
                value="<?php echo $categoria ?>"/>
            </div>
            <br>
            <div>
                <label for="quantidade">Quantidade:</label>
                <br>
                <input id = "quantidade" type="number" name="quantidade" class="input" required 
                value="<?php echo $quantidade ?>"/>
            </div>
            <br>
            <div>
                <label for="valor_medio">Valor Medio:</label>
                <br>
                <input id="valor_medio" type="text" name="valor_medio" class="input" required 
                value="<?php echo $valor_medio ?>"/>
            </div>
            <br>

        </form>

        <button class="button" onclick="atualizar()">Cadastrar
        </button>
        <button class = "button" onclick="window.location.href='listagem.php'">Voltar</button>
    </div>
    <script>
        function atualizar(){
            var id = document.getElementById('id').value
            var nome = document.getElementById('nome').value
            var categoria = document.getElementById('categoria').value
            categoria = categoria.split(",")
            categorias = ""
            for (var i=0; i< categoria.length; i++){
                categorias += categoria[i].toString()
            }

            var quantidade = document.getElementById('quantidade').value
            var valor_medio = document.getElementById('valor_medio').value
            if (id != ""){
                window.location.href='atualiza.php?id='+id+'&nome='+nome+'&categoria='+categoria+'&quantidade='+quantidade+'&valor_medio='+valor_medio+''
            }else{
                window.location.href='cadastra.php?nome='+nome+'&categoria='+categoria+'&quantidade='+quantidade+'&valor_medio='+valor_medio+''
            }
        }
    </script>
</body>
</html>