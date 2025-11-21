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
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dataNasc = $_POST['dataNascimento'];
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
            cpf = ?,
            data_nasc = ?,
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
    <link rel="stylesheet" href="../../css/perfil.css">
    <script src="../../JS/padrao.js" defer></script>
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
    <h1>Editar Perfil</h1>

    <!-- Foto igual ao perfil.php -->
    <img src="../../IMG/usuario/<?= htmlspecialchars($usuario['foto']) ?>" 
         class="fotoPerfil" alt="Foto do perfil">

    <form method="POST" enctype="multipart/form-data" class="formEditar">

        <div class="info">
            <label>Nome Completo:</label>
            <input type="text" name="nome" 
                   value="<?= htmlspecialchars($usuario['nome']) ?>" required>
        </div>

        <div class="info">
            <label>CPF:</label>
            <input type="email" name="cpf" 
                   value="<?= htmlspecialchars($usuario['cpf']) ?>" required>
        </div>
        
        <div class="info">
            <label>Data de Nascimento:</label>
            <input type="email" name="dataNascimento" 
                   value="<?= htmlspecialchars($usuario['data_nasc']) ?>" required>
        </div>
        
        <div class="info">
            <label>E-mail:</label>
            <input type="email" name="email" 
                   value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <div class="numeros">
            <div class="info tel">
                <label>Telefone:</label>
                <input type="text" name="telefone" 
                    value="<?= htmlspecialchars($usuario['telefone']) ?>">
            </div>

            <div class="info zap">
                <label>WhatsApp:</label>
                <input type="text" name="whats" 
                    value="<?= htmlspecialchars($usuario['whatsapp']) ?>">
            </div>
        </div>

        <div class="locais">
            <div class="info estado">
                <label>Estado:</label>
                <input type="text" name="estado" 
                    value="<?= htmlspecialchars($usuario['estado']) ?>">
            </div>

            <div class="info cidade">
                <label>Cidade:</label>
                <input type="text" name="cidade" 
                       value="<?= htmlspecialchars($usuario['cidade']) ?>">
            </div>
        </div>

        <div class="info">
            <label>Nova Senha (opcional):</label>
            <input type="password" name="senha" 
                   placeholder="Deixe vazio para manter a atual">
        </div>

        <div class="info">
            <label>Nova Foto (opcional):</label>
            <input type="file" name="foto">
        </div>

        <!-- BOTÕES iguais ao perfil.php -->
        <div id="registrar">
            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="perfil.php" class="btn btn-primary">Voltar</a>
        </div>
    </form>
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