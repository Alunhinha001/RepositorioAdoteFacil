<?php
session_start();
require "../conexao.php";

// Se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Sessão expirada. Faça login novamente.'); window.location.href='entrar.html';</script>";
    exit;
}

$id_usuario = $_SESSION['usuario_id'];

// ---------------------- //
// PROCESSAR O FORMULÁRIO //
// ---------------------- //
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitização
    $nome = $_POST['nomeDoador'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $whatsapp = $_POST['whats'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $senha = trim($_POST['senha']);

    // FOTO
    $novoNomeFoto = null;
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novoNomeFoto = uniqid() . "." . $ext;

        move_uploaded_file($_FILES['foto']['tmp_name'], "../../IMG/usuario/" . $novoNomeFoto);
    }

    // Monta UPDATE
    $sql = "UPDATE cliente SET 
            nomeCompleto = ?, 
            email = ?, 
            telefone = ?, 
            whatsapp = ?, 
            estado = ?, 
            cidade = ?";

    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = '$senhaHash'";
    }

    if (!empty($novoNomeFoto)) {
        $sql .= ", foto = '$novoNomeFoto'";
    }

    $sql .= " WHERE id_cliente = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $email, $telefone, $whatsapp, $estado, $cidade, $id_usuario);
    $stmt->execute();

    echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='editar.php';</script>";
    exit;
}

// --------------------------- //
// BUSCA OS DADOS DO USUÁRIO   //
// --------------------------- //
$sql = "SELECT * FROM cliente WHERE id_cliente = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$res = $stmt->get_result();
$usuario = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>

    <link rel="stylesheet" href="../../css/padrao.css">
    <link rel="stylesheet" href="../../css/index.css">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: "Poppins", sans-serif;
        }

        .container {
            max-width: 550px;
            background: #fff;
            padding: 30px;
            margin: 40px auto;
            border-radius: 16px;
            box-shadow: 0 0 10px #0002;
        }

        h1 {
            color: #7a8ccb;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .fotoAtual {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #7a8ccb;
            display: block;
            margin: 0 auto 20px auto;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #aaa;
            margin-top: 5px;
        }

        button {
            width: 100%;
            background: #7a8ccb;
            color: #fff;
            padding: 15px;
            margin-top: 25px;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            transition: .3s;
            cursor: pointer;
        }

        button:hover {
            background: #6577c2;
        }

        .buttonSair{
            background-color: #f00;
        }

        .buttonSair:hover{
            background-color: rgba(224, 2, 2, 1);
        }

        .buttonSair a{
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Editar Perfil</h1>

    <img src="../../IMG/usuario/<?= htmlspecialchars($usuario['foto']) ?>" class="fotoAtual" alt="Foto atual">

    <form method="POST" enctype="multipart/form-data">

        <label>Nome Completo</label>
        <input type="text" name="nomeDoador" value="<?= htmlspecialchars($usuario['nomeCompleto']) ?>" required>

        <label>E-mail</label>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <label>Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>">

        <label>WhatsApp</label>
        <input type="text" name="whats" value="<?= htmlspecialchars($usuario['whatsapp']) ?>">

        <label>Estado</label>
        <input type="text" name="estado" value="<?= htmlspecialchars($usuario['estado']) ?>">

        <label>Cidade</label>
        <input type="text" name="cidade" value="<?= htmlspecialchars($usuario['cidade']) ?>">

        <label>Nova Senha (opcional)</label>
        <input type="password" name="senha" placeholder="Deixe vazio para manter a atual">

        <label>Nova Foto (opcional)</label>
        <input type="file" name="foto">

        <button type="submit">Salvar Alterações</button>
    </form>
    <a href="perfil.php"><button class="buttonSair">Sair</button></a>
</div>

</body>
</html>