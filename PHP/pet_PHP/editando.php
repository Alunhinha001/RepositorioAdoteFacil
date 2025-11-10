<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../conexao.php');

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM pet WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $pet = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Pet não encontrado.";
        exit;
    }
} else {
    echo "ID do pet não fornecido.";
    exit;
}

// Atualiza o pet se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $peso = $_POST['peso'];
    $idade = $_POST['idade'];
    $especie = $_POST['especie'];
    $porte = $_POST['porte'];
    $raca = $_POST['raca'];
    $localidade = $_POST['localidade'];
    $sobrePet = $_POST['sobrePet'];
    $foto = $_POST['foto'];

    $sql = "UPDATE pet 
            SET nome = :nome, genero = :genero, peso = :peso, idade = :idade, 
                especie = :especie, porte = :porte, raca = :raca, localidade = :localidade, 
                sobrePet = :sobrePet, foto = :foto 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':especie', $especie);
    $stmt->bindParam(':porte', $porte);
    $stmt->bindParam(':raca', $raca);
    $stmt->bindParam(':localidade', $localidade);
    $stmt->bindParam(':sobrePet', $sobrePet);
    $stmt->bindParam(':foto', $foto);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: consultapet.php");
        exit;
    } else {
        echo "Erro ao atualizar o pet.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Pet</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/editar.css">
    <link rel="stylesheet" href="../../css/padrao.css">
    <script src="/JS/index.js" defer></script>
</head>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.html"><img src="../../images/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
        </div>
        <div class="dropdown">
            <input type="checkbox" id="burger-menu">
            <label class="burger" for="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class="dropdown-content">
                <a href="index.html" id="inicio">Início</a>
                <a href="sobre.html">Sobre Nós</a>
                <a href="adote.html">Adote um pet</a>
                <a href="comoajudar.html">Como ajudar</a>
                <a href="entrar.html">Entrar</a>
            </div>
        </div>
    </nav>
</header>
<body>
<main>
    
    <form method="POST">
        <h1>Editar as Informações do Pet</h1>
        <div class="form-section">
            <div class="input-group">
                <label for="nome">Nome do Pet</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($pet['nome']); ?>" required>
            </div>

            <div class="input-group">
                <label for="genero">Gênero</label>
                <input type="text" name="genero" id="genero" value="<?php echo htmlspecialchars($pet['genero']); ?>" required>
            </div>

            <div class="input-group">
                <label for="peso">Peso (kg)</label>
                <input type="number" name="peso" id="peso" value="<?php echo htmlspecialchars($pet['peso']); ?>" required>
            </div>

            <div class="input-group">
                <label for="idade">Idade aproximada (anos)</label>
                <input type="number" name="idade" id="idade" value="<?php echo htmlspecialchars($pet['idade']); ?>" required>
            </div>

            <div class="input-group">
                <label for="especie">Espécie</label>
                <input type="text" name="especie" id="especie" value="<?php echo htmlspecialchars($pet['especie']); ?>" required>
            </div>

            <div class="input-group">
                <label for="porte">Porte</label>
                <input type="text" name="porte" id="porte" value="<?php echo htmlspecialchars($pet['porte']); ?>" required>
            </div>

            <div class="input-group">
                <label for="raca">Raça</label>
                <input type="text" name="raca" id="raca" value="<?php echo htmlspecialchars($pet['raca']); ?>" required>
            </div>

            <div class="input-group">
                <label for="localidade">Localização</label>
                <input type="text" name="localidade" id="localidade" value="<?php echo htmlspecialchars($pet['localidade']); ?>" required>
            </div>

            <div class="input-group">
                <label for="foto">Foto do Pet</label>
                <input type="text" name="foto" id="foto" value="<?php echo htmlspecialchars($pet['foto']); ?>" required>
            </div>

            <div class="input-group">
                <label for="sobrePet">Sobre o Pet</label>
                <input type="text" name="sobrePet" id="sobrePet" value="<?php echo htmlspecialchars($pet['sobrePet']); ?>" required>
            </div>

            <input type="submit" value="Atualizar Informações">
        </div>
    </form>

    <form action="deleter.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este pet?');">
        <input type="hidden" name="id" value="<?php echo $pet['id']; ?>">
        <button type="submit">Deletar Pet</button>
    </form>

    <a href="consulta.php" class="voltar-link">Voltar</a>
</main>

<footer>
    <div class="footer-coluna" id="cl1">
        <h2>Peludinhos do Bem</h2>
        <p>08989-8989898</p>
        <p>Rua Santa Helena, 21, Parque Alvorada, Imperatriz - MA, CEP 65919-505</p>
        <p>adotefacil@peludinhosdobem.org</p>
    </div>
    <div class="footer-coluna" id="cl2">
        <a href="sobre.html"><h2>Conheça a História da Peludinhos do Bem</h2></a>
    </div>
    <div class="footer-coluna" id="cl3">
        <div class="app-link">
            <p>DISPONÍVEL NA</p>
            <a href="https://play.google.com/store/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" style="height: 40px;">
            </a>
        </div>
        <div class="app-link">
            <p>AVAILABLE ON THE</p>
            <a href="https://www.apple.com/app-store/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="App Store" style="height: 40px;">
            </a>
        </div>
    </div>
    <div class="footer-rodape">
        <p>&copy; 2025 by Peludinhos do Bem. Todos os direitos reservados.</p>
    </div>
</footer>
</body>
</html>
