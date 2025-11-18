<?php
session_start();
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../Paginas/entrar.html');
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id_cliente, nomeCompleto, email, senha, foto 
        FROM cliente 
        WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "Email não encontrado";
    exit;
}

$user = $res->fetch_assoc();

// verifica senha
if (password_verify($senha, $user['senha'])) {

    // 🔥 SESSÕES COM OS NOMES CORRETOS
    $_SESSION['usuario_id']    = $user['id_cliente'];
    $_SESSION['usuario_nome']  = $user['nomeCompleto'];
    $_SESSION['usuario_email'] = $user['email'];
    $_SESSION['usuario_foto']  = $user['foto'];

    header('Location: ../../index.php');
    exit;

} else {
    echo "Senha incorreta";
}
