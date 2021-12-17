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
        <br>
        <h2 class="topo"> Bem-vindo! </h2>
    </header>
    <div class="form-cadastro">
        <form action="autenticar.php" method="post">
            <div>
                <label for="login">Login</label>
                <br>
                <input type="text" name="login" id="login" class="input" required 
                value=""/>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <br>
                <input type="password"  class="input" name="senha" id="senha" required
                value=""/>
            </div>
        </form>
        <br>
        <button class="button" onclick="autenticar()">Entrar
        </button>
    </div>
    <script>
        function autenticar(){
            var login = document.getElementById('login').value;
            var senha = document.getElementById('senha').value;
            window.location.href='autenticar.php?login='+login+'&senha='+senha;
        }
    </script>
    </div>
</body>
</html>