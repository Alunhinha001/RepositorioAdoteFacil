<?php
include "conexao2.php";
    // recebe is valores enviados via POST da página cadastro.html
    $nome = $_POST['nomeDoador'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $whatsapp = $_POST['whats'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $senha = $_POST['senha'];
    $fotoNome = $_FILES['foto']['name'];
    $fotoTemp = $_FILES['foto']['tmp_name'];
    $fotoCaminho = '../../imagens/' . $fotoNome;

    move_uploaded_file($fotoTemp, $fotoCaminho);

    //inserir os valores das variáveis na tabela cliente do banco login
    $inserirSQL = "INSERT INTO cliente(nomeCompleto, email, telefone, whatsapp, estado, cidade, senha, foto) 
                    VALUES ('$nome', '$email', '$telefone', '$whatsapp', '$estado', '$cidade', '$senha', '$fotoNome')";
    //OBS: sempre que os valores forem do tipo VARCHAR, deve ficar entre 'aspas simples'

    // Verificação
    if (mysqli_query($conexao, $inserirSQL)) {
        echo "Usuário Cadastrado!";
        header('Location: ../../entrar.html');
    } else {
        echo "Usuário não cadastrado. Erro: ".mysqli_connect_error($conexao);
    }

    // Encerra a conexão para evitar travamentos no banco de dados
    mysqli_close($conexao);

include('conexao.php');

//------------------------------PROCESSANDO IMAGEM-------------------------------------------
// Pasta onde as imagens serão salvas
$pastaDestino = "../../images/adote/";

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
    } elseif (!in_array($tipoImagem, ["jpg", "jpeg", "png", "gif"])) {
        $mensagem = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
    } elseif (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoFinal)) {
        $mensagem = "Upload realizado com sucesso!";
        $caminhoImagem = $caminhoFinal; }
//---------------------FIM PROCESSO IMAGEM---------------------------------------------------------------------------------------

    try {
        $sql = "INSERT INTO pet 
                (nome, genero, peso, idade, especie, porte, raca, localidade, sobrePet, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $inserir = $conn->prepare($sql);
        $inserir->execute([$nome, $genero, $peso, $idade, $especie, $porte, $raca, $localidade, $sobre, $foto]);

        header("Location: ../index.html");
        exit;

    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
}
?>