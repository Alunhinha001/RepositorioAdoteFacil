<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../conexao.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['online']) || !isset($_SESSION['idUsuario'])) {
    echo "<script>alert('Sessão expirada. Faça login novamente.'); window.location.href='../../entrar.html';</script>";
    exit;
}

$id_usuario = $_SESSION['idUsuario'];

// Recebe os valores do formulário
$nome = mysqli_real_escape_string($conexao, $_POST['nomeDoador']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
$whatsapp = mysqli_real_escape_string($conexao, $_POST['whats']);
$estado = mysqli_real_escape_string($conexao, $_POST['estado']);
$cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
$senha = trim($_POST['senha']);

// --- Upload da foto (opcional)
$fotoNome = $_FILES['foto']['name'] ?? '';
$fotoTemp = $_FILES['foto']['tmp_name'] ?? '';

if (!empty($fotoNome)) {
    // Gera um nome único para evitar conflito
    $fotoNome = uniqid() . "_" . basename($fotoNome);
    $fotoCaminho = '../../IMG/usuario' . $fotoNome;

    // Move a foto para a pasta
    move_uploaded_file($fotoTemp, $fotoCaminho);
}

// --- Monta o SQL dinamicamente ---
$sql = "UPDATE cliente SET 
            nomeCompleto = '$nome', 
            email = '$email', 
            telefone = '$telefone', 
            whatsapp = '$whatsapp', 
            estado = '$estado', 
            cidade = '$cidade'";

// Se a senha foi preenchida, inclui na query
if (!empty($senha)) {
    $sql .= ", senha = '$senha'";
}

// Se o usuário enviou uma nova foto, atualiza também
if (!empty($fotoNome)) {
    $sql .= ", foto = '$fotoNome'";
}

$sql .= " WHERE id = '$id_usuario'";

// --- Executa o update ---
if (mysqli_query($conexao, $sql)) {
    // Atualiza os dados na sessão para refletir as mudanças
    $_SESSION['nomeCompleto'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['telefone'] = $telefone;
    $_SESSION['whatsapp'] = $whatsapp;
    $_SESSION['estado'] = $estado;
    $_SESSION['cidade'] = $cidade;

    if (!empty($senha)) {
        $_SESSION['senha'] = $senha;
    }

    if (!empty($fotoNome)) {
        $_SESSION['foto'] = $fotoNome;
    }

    echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='perfil.php';</script>";
} else {
    echo "Erro ao atualizar: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
