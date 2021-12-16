<?php
    $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");

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
        <h1 class="topo"> Bem vindo </h1>
    </header>
    <div class="form-cadastro">
        <form action=".php" method="post">
            <div>
                <label for="login">LOGIN</label>
                <br>
                <input type="text" name="login" class="input" required 
                value="<?php echo $login?>"/>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <br>
                <input type="password"  class="input" id="senha_login" required
                value="<?php echo $senha?>"/>
            </div>
            <br>
            <div>
                <button class="button" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>