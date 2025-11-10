<?php
require_once 'conexao2.php';
session_start();

if (isset($_POST['bt-entrar'])) {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verificação básica
    if (empty($email) || empty($senha)) {
        echo "<script>alert('Todos os campos devem ser preenchidos!');</script>";
        header('Location: ../entrar.html');
        exit();
    }

    // Prepara a query (evita SQL Injection)
    $stmt = $conexao->prepare("SELECT * FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();

        // Verifica a senha
        // (Se as senhas estiverem em texto puro no banco, use comparação simples abaixo)
        if ($dados['senha'] === $senha) {
            // Inicia sessão do usuário
            $_SESSION['online'] = true;
            $_SESSION['idUsuario'] = $dados['id'];
            $_SESSION['nomeUsuario'] = $dados['nomeCompleto'];
            $_SESSION['emailUsuario'] = $dados['email'];
            $_SESSION['senhaUsuario'] = $dados['senha'];
            $_SESSION['telefoneUsuario'] = $dados['telefone'];
            $_SESSION['whatsUsuario'] = $dados['whatsapp'];
            $_SESSION['estadoUsuario'] = $dados['estado'];
            $_SESSION['cidadeUsuario'] = $dados['cidade'];

            // (opcional) foto de perfil
            if (!empty($dados['foto'])) {
                $_SESSION['fotoUsuario'] = $dados['foto'];
            }

            header('Location: index-logado.php');
            exit();

        } else {
            echo "<script>alert('Usuário ou senha incorretos.');</script>";
            header('Location: ../entrar.html');
            exit();
        }
    } else {
        echo "<script>alert('Usuário não encontrado.');</script>";
        header('Location: ../entrar.html');
        exit();
    }
}
?>
