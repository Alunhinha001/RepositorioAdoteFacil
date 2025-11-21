<?php
$servidor = "localhost";
$usuario  = "root";
$senha    = ""; 
$dbname   = "adotefacil";

$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Definir charset para utf8
mysqli_set_charset($conexao, "utf8");
?>