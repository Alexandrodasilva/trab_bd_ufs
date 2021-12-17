<?php

   if(empty($_GET['login']) And empty(MD5($_GET['senha']))){
        header('Location: login.php');
        exit();
    }else{

        $login = $_GET['login'];
        $senha = $_GET['senha'];
        echo $login;
        echo $senha;
        $db_handle = pg_connect("host=database.cdfwtenhuhmz.us-east-1.rds.amazonaws.com user=banco_dados dbname=postgres password=professorbd");
        $query = "SELECT * FROM estoque.usuario WHERE usuario = '$login' AND senha = '$senha'"; 
        $result = pg_query($db_handle, $query); 
        $row = pg_numrows($result); 
        echo $row;
        if($row == 1){
            //$_SESSION['usuario'] = $login;
            header('Location: listagem.php');

        }else{
            header('Location: login.php');
            exit();

        }
    }
?>