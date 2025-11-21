<?php
require_once '../../conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método inválido.");
}

// Validação básica dos campos obrigatórios
$camposObrigatorios = ['nome', 'genero', 'peso', 'idade', 'especie', 'porte', 'raca', 'local', 'vacinado', 'castrado', 'sobre'];
foreach ($camposObrigatorios as $campo) {
    if (empty($_POST[$campo])) {
        die("O campo $campo é obrigatório.");
    }
}

// Recebe e sanitiza os dados
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$genero = mysqli_real_escape_string($conexao, $_POST['genero']);
$peso = floatval($_POST['peso']);
$idade = intval($_POST['idade']);
$especie = mysqli_real_escape_string($conexao, $_POST['especie']);
$porte = mysqli_real_escape_string($conexao, $_POST['porte']);
$raca = mysqli_real_escape_string($conexao, $_POST['raca']);
$local = mysqli_real_escape_string($conexao, $_POST['local']);
$vacinado = mysqli_real_escape_string($conexao, $_POST['vacinado']);
$castrado = mysqli_real_escape_string($conexao, $_POST['castrado']);
$sobre = mysqli_real_escape_string($conexao, $_POST['sobre']);

// ------------------ UPLOAD DA IMAGEM --------------------
$destino = "../../IMG/adote/";

if (!is_dir($destino)) {
    mkdir($destino, 0755, true);
}

// Verifica se o arquivo foi enviado
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    die("Erro no upload da imagem.");
}

$nomeImagem = uniqid() . "_" . basename($_FILES['foto']['name']);
$caminhoFinal = $destino . $nomeImagem;

$extensao = strtolower(pathinfo($caminhoFinal, PATHINFO_EXTENSION));
$permitidas = ["jpg", "jpeg", "png", "gif", "webp"];

if (!in_array($extensao, $permitidas)) {
    die("Extensão inválida. Use apenas: " . implode(", ", $permitidas));
}

if ($_FILES["foto"]["size"] > 2 * 1024 * 1024) { 
    die("Imagem maior que 2MB.");
}

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoFinal)) {
    die("Erro ao enviar imagem.");
}

// ------------------- INSERINDO NO BANCO --------------------
// Usando caminho relativo para armazenar no banco
$caminhoBanco = "IMG/adote/" . $nomeImagem;

$sql = "INSERT INTO pet (nome, genero, peso, idade, especie, porte, raca, localidade, vacinado, castrado, sobrePet, foto) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);
if (!$stmt) {
    die("Erro na preparação da query: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "ssdiisssssss", 
    $nome, $genero, $peso, $idade, $especie, $porte, $raca, $local, $vacinado, $castrado, $sobre, $caminhoBanco
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../index.php?sucesso=1");
    exit;
} else {
    echo "Erro ao salvar: " . mysqli_error($conexao);
}

mysqli_stmt_close($stmt);
?>