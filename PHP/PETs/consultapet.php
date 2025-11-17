<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../conexao.php');

$sql = "SELECT id, nome, especie, raca, genero, porte, localidade FROM pet";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>
    <link rel="stylesheet" href="../../css/padrao.css">
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
    <h1>Lista de Pets Cadastrados</h1>

    <?php if (count($pets) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Gênero</th>
                    <th>Porte</th>
                    <th>Localidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pets as $pet): ?>
                    <tr>
                        <td><?= htmlspecialchars($pet['id']); ?></td>
                        <td><?= htmlspecialchars($pet['nome']); ?></td>
                        <td><?= htmlspecialchars($pet['especie']); ?></td>
                        <td><?= htmlspecialchars($pet['raca']); ?></td>
                        <td><?= htmlspecialchars($pet['genero']); ?></td>
                        <td><?= htmlspecialchars($pet['porte']); ?></td>
                        <td><?= htmlspecialchars($pet['localidade']); ?></td>
                        <td>
                            <a href="editar.php?id=<?= $pet['id']; ?>">Editar</a> | 
                            <a href="deleter.php?id=<?= $pet['id']; ?>" onclick="return confirm('Deseja realmente excluir este pet?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum pet cadastrado.</p>
    <?php endif; ?>

    <a href="../../index.html">Voltar</a>
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
