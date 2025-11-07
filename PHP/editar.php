<?php
include "conexao2.php";
session_start();

// Verifica se o usuário está logado e tem um ID válido
if(!isset($_SESSION['online']) || !isset($_SESSION['idUsuario'])){
    echo "<script>alert('Sessão expirada. Faça login novamente.'); window.location.href='../entrar.html';</script>";
    exit;
}

$id_usuario = $_SESSION['idUsuario'];

// Recebe os valores do formulário
$nome = $_POST['nomeDoador'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whats'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$senha = $_POST['senha'];

// Atualiza os dados no banco de dados
$updateSQL = "
    UPDATE cliente 
    SET 
        nomeCompleto = '$nome', 
        email = '$email', 
        telefone = '$telefone', 
        whatsapp = '$whatsapp', 
        estado = '$estado', 
        cidade = '$cidade', 
        senha = '$senha'
    WHERE id = '$id_usuario'
";

// Verificação
if (mysqli_query($conexao, $updateSQL)) {
    echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='../entrar.html';</script>";
} else {
    echo "Erro ao atualizar o usuário: " . mysqli_error($conexao);
}

// Encerra a conexão
mysqli_close($conexao);
?>
