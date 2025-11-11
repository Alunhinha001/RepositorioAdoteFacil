<?php
    $host = 'localhost:8889';
    $dbname = 'adotefacil';
    $username = 'root';
    $password = 'root';

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo "Conexão com o banco de dados realizado com sucesso!";
    } catch (PDOException $e) {
        echo 'Erro de conexão: ' . $e->getMessage();
    }
?>