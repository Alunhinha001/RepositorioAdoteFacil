<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "root";
    $dbname = "adotefacil";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

    if (!$conexao) {
        die("Conexão não realizada, erro: ".mysqli_connect_error());
    }else {
        //echo "Conexão realizada com sucesso!";
    }
?>