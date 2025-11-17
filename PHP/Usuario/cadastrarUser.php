<?php
session_start();
include "../conexao.php";

// Recebe valores via POST
$nome      = $_POST['nomeDoador'];
$email     = $_POST['email'];
$telefone  = $_POST['telefone'];
$whatsapp  = $_POST['whats'];
$estado    = $_POST['estado'];
$cidade    = $_POST['cidade'];
$senhaRaw  = $_POST['senha'];

// Criptografa a senha
$senha = password_hash($senhaRaw, PASSWORD_DEFAULT);

// ------------------
// UPLOAD DA FOTO
// ------------------
$fotoNome = null;

if (!empty($_FILES['foto']['name'])) {

    // Pasta onde será salva a foto
    $pasta = "../../IMG/usuario/";

    // Cria pasta se não existir
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    // Nome único para a foto
    $fotoNome = uniqid() . "-" . $_FILES['foto']['name'];

    $fotoTemp = $_FILES['foto']['tmp_name'];
    $caminhoFinal = $pasta . $fotoNome;

    move_uploaded_file($fotoTemp, $caminhoFinal);
}

// ------------------
// INSERIR NO BANCO
// ------------------
$inserirSQL = "INSERT INTO cliente 
(nomeCompleto, email, telefone, whatsapp, estado, cidade, senha, foto) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($inserirSQL);
$stmt->bind_param(
    "ssssssss",
    $nome,
    $email,
    $telefone,
    $whatsapp,
    $estado,
    $cidade,
    $senha,
    $fotoNome
);

if ($stmt->execute()) {

    // Criar sessão automaticamente (USUÁRIO LOGADO)
    $_SESSION['usuario'] = [
        "id"        => $stmt->insert_id,
        "nome"      => $nome,
        "email"     => $email,
        "telefone"  => $telefone,
        "cidade"    => $cidade,
        "estado"    => $estado,
        "foto"      => $fotoNome
    ];

    header("Location: ../../Paginas/entrar.php");
    exit;

} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$conexao->close();
?>
