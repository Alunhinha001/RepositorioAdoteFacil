<?php
require_once '../conexao.php';
echo "Conexão realizada";

// Recebe os dados do formulário
$nome = $_POST['nome'];
$genero = $_POST['genero'];
$peso = $_POST['peso'];
$idade = $_POST['idade'];
$especie = $_POST['especie'];
$porte = $_POST['porte'];
$raca = $_POST['raca'];
$localidade = $_POST['local'];
$sobre = $_POST['sobre'];

//------------------------------PROCESSANDO IMAGEM-------------------------------------------
// Pasta onde as imagens serão salvas
$pastaDestino = "../../IMG/adote/";

// Cria a pasta se não existir
if (!file_exists($pastaDestino)) {
    mkdir($pastaDestino, 0755, true);
}

$mensagem = "";
$caminhoImagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Gera nome único para a imagem
    $nomeImagem = uniqid() . "_" . basename($_FILES["foto"]["name"]);
    $caminhoFinal = $pastaDestino . $nomeImagem;
    $tipoImagem = strtolower(pathinfo($caminhoFinal, PATHINFO_EXTENSION));

    // Verifica se é uma imagem válida
    $verificacao = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($verificacao === false) {
        $mensagem = "O arquivo enviado não é uma imagem.";
    } elseif ($_FILES["foto"]["size"] > 2 * 1024 * 1024) {
        $mensagem = "A imagem é muito grande (máx. 2MB).";
    } elseif (!in_array($tipoImagem, ["jpg", "jpeg", "png", "gif", "webp"])) {
        $mensagem = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
    } elseif (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoFinal)) {
        $mensagem = "Upload realizado com sucesso!";
        $caminhoImagem = $caminhoFinal;
//---------------------FIM PROCESSO IMAGEM---------------------------------------------------------------------------------------
        $sql = "INSERT INTO pet (nome, genero, peso, idade, especie, porte, raca, localidade, sobrePet, foto) VALUES ('$nome', '$genero', '$peso', '$idade', '$especie', '$porte', '$raca', '$localidade', '$sobre', '$caminhoImagem')";
    if (mysqli_query($conexao, $sql)) {
       echo "Cadastro realizado com sucesso!";
       header("Location: ../../index.html");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
} else {
     $mensagem = "Erro ao mover a imagem para o servidor.";
}
}
?>