<?php
require_once 'conexao2.php';
session_start();

if (isset($_POST['bt-entrar'])) {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verifica campos
    if (empty($email) || empty($senha)) {
        echo "<script>alert('Todos os campos devem ser preenchidos!'); window.location.href='../entrar.html';</script>";
        exit();
    }

    // Consulta no banco
    $stmt = $conexao->prepare("SELECT * FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();

        // Verifica senha (texto puro)
        if ($dados['senha'] === $senha) {
            $_SESSION['online'] = true;
            $_SESSION['idUsuario'] = $dados['id'];
            $_SESSION['nomeUsuario'] = $dados['nomeCompleto'];
            $_SESSION['emailUsuario'] = $dados['email'];
            $_SESSION['telefoneUsuario'] = $dados['telefone'];
            $_SESSION['whatsUsuario'] = $dados['whatsapp'];
            $_SESSION['estadoUsuario'] = $dados['estado'];
            $_SESSION['cidadeUsuario'] = $dados['cidade'];
            if (!empty($dados['foto'])) {
                $_SESSION['fotoUsuario'] = $dados['foto'];
            }

            // Redireciona corretamente
            header('Location: ../index-logado.php');
            exit();
        } else {
            echo "<script>alert('Usuário ou senha incorretos.'); window.location.href='../entrar.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Usuário não encontrado.'); window.location.href='../entrar.html';</script>";
        exit();
    }
} else {
    // Se o botão não for clicado, volta pro login
    header('Location: ../entrar.html');
    exit();
}
?>
