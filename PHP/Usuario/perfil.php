<?php
session_start();
require '../conexao.php';


if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../Paginas/entrar.html');
    exit;
}

$id_usuario = $_SESSION['usuario_id'];

$sql = "SELECT * FROM cliente WHERE id_cliente = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuário não encontrado.");
}

$usuario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="../../JS/delete.js" defer></script>
    <link rel="stylesheet" href="../../CSS/perfil.css">
    <link rel="stylesheet" href="../../CSS/padrao.css">
    <script src="../../JS/padrao.js" defer></script>
    <title>Perfil</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="../../index.php"><img src="../../IMG/Logotipo.jpg" alt="logo_Adote_Fácil"></a>
            </div>
            <div class="dropdown">
                <input type="checkbox" id="burger-menu">
                <label class="burger" for="burger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
                <div class="dropdown-content">
                    <a href="../../index.php">Início</a>
                    <a href="../../Paginas/sobre.html">Sobre Nós</a>
                    <a href="../../Paginas/adote.php">Adote um pet</a>
                    <a href="../../Paginas/comoajudar.html">Como ajudar</a>

                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                        <a href="Paginas/entrar.html" id="btn-entrar" class="botao-entrar">Entrar</a>
                    <?php else: ?>
                        <div class="usuario-box" id="userMenu">
                            <img src="../../IMG/usuario/<?php echo $_SESSION['usuario_foto']; ?>" 
                                class="foto-perfil" alt="Foto">

                            <div class="dropdown-user">
                                <span class="nome-dropdown">
                                    <?php echo explode(" ", $_SESSION['usuario_nome'])[0]; ?>
                                </span>

                                <a href="../../PHP/Usuario/perfil.php">Perfil</a>
                                <a href="../../PHP/Usuario/logout.php">Sair</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
            <h1>Perfil do Usuário</h1>

        <div class="">
            <img src="../../IMG/usuario/<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto do perfil" class="fotoPerfil">
        </div>
        <div class="info">
            <strong>Nome:</strong> <?= htmlspecialchars($usuario['nomeCompleto']) ?>
        </div>
        <div class="info">
            <strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?>
        </div>
        <div class="numeros">
            <div class="info tel">
            <strong>Telefone:</strong> <?= htmlspecialchars($usuario['telefone']) ?>
            </div>
            <div class="info zap">
                <strong>WhatsApp:</strong> <?= htmlspecialchars($usuario['whatsapp']) ?>
            </div>
        </div>
        
        <div class="locais">
            <div class="info estado">
                <strong>Estado:</strong> <?= htmlspecialchars($usuario['estado']) ?>
            </div>
            <div class="info cidade">
                <strong>Cidade:</strong> <?= htmlspecialchars($usuario['cidade']) ?>
            </div>
        </div>
        
        <div id="registrar">
            <a href="../../Paginas/entrar.html" class="btn btn-primary">Sair</a>
            <a href="editar.php" class="btn btn-primary">Editar</a>
            <form action="delete.php" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar sua conta?');">
                <button type="submit">Deletar</button>
            </form>
        </div>
    </div>


    <footer>
        <div class="footer-coluna" id="cl1">
            <h2>Peludinhos do bem</h2>
            <p>08989-8989898</p>
            <p>Rua Santa Helena, 21, Parque Alvorada,<br> Imperatriz-MA, CEP 65919-505</p>
            <p>adotefacil@peludinhosdobem.org</p>
        </div>
        <div class="footer-coluna" id="cl2">
            <a href="sobre.html"></a>
            <h2>Conheça a História da Peludinhos do Bem</h2>
        </div>
        <div class="footer-coluna" id="cl3">
            <h2>Contatos</h2>
            <div class="icons-row">
                <a href="https://www.instagram.com/">
                    <img src="../../IMG/index/insta.png" alt="Instagram">
                </a>
                <a href="https://web.whatsapp.com/">
                    <img src="../../IMG/index/—Pngtree—whatsapp icon whatsapp logo whatsapp_3584845.png" alt="Whatsapp">
                </a>
            </div>
        </div>
        <div class="footer-rodape">
            <p>Desenvolvido pela Turma-20 Tecnico de Informatica para Internet (Peludinhos do Bem). 2025 &copy;Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
