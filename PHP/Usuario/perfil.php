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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="../../JS/delete.js" defer></script>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/padrao.css">
    <style>
        /* === RESET === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            width: 100%;
            margin: 0 auto;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f8f8;
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* === CONTAINER DO PERFIL === */
        .container {
            background-color: #ffffff;
            max-width: 500px;
            width: 90%;
            margin: 40px auto;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            text-align: center;
            animation: fadeIn 0.8s ease-out;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* === TÍTULO === */
        .container h1 {
            color: #7a8ccb;
            font-weight: 700;
            margin-bottom: 25px;
        }

        /* === FOTO DO PERFIL === */
        .fotoPerfil {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #7a8ccb;
            margin-bottom: 25px;
        }

        /* === INFORMAÇÕES === */
        .info {
            background-color: #e9ebff;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 12px;
            width: 100%;
            text-align: left;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .info:hover {
            background-color: #d7dbff;
        }

        /* === BOTÕES === */
        #registrar {
            margin-top: 25px;
            width: 100%;
            display: flex;
            gap: 12px;
        }

        #registrar a,
        #registrar button {
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        /* === Botões padrão === */
        #registrar a.btn {
            background-color: #7a8ccb;
            color: #fff;
            text-decoration: none;
        }

        #registrar a.btn:hover {
            background-color: #6577c2;
            transform: scale(1.02);
        }

        /* === Botão Deletar === */
        #registrar button {
            background-color: #ff4b4b;
            color: #fff;
        }

        #registrar button:hover {
            background-color: #d93b3b;
            transform: scale(1.02);
        }

        /* === ANIMAÇÃO === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === RESPONSIVO === */
        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
            }

            .fotoPerfil {
                width: 140px;
                height: 140px;
            }

            .info {
                font-size: 15px;
            }

            #registrar a,
            #registrar button {
                font-size: 15px;
            }
        }

    </style>
    <title>Perfil</title>
</head>
<body>

        <header>
            <nav class="navbar">
                <div class="logo">
                <a href="index.html"><img src="../../IMG/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
                </div>
                <div class="dropdown">
                    <input type="checkbox" id="burger-menu">
                    <label class="burger" for="burger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    </label>

                    <div class="dropdown-content">
                    <a href="../../index.html" id="inicio">Início</a>
                    <a href="../../Paginas/sobre.html">Sobre Nós</a>
                    <a href="../../Paginas/adote.php">Adote um pet</a>
                    <a href="../../Paginas/comoajudar.html">Como ajudar</a>
                    <a href="../../Paginas/entrar.html">Entrar</a>
                    <a href="perfil.php">perfil</a>
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
        <div class="info">
            <strong>Telefone:</strong> <?= htmlspecialchars($usuario['telefone']) ?>
        </div>
        <div class="info">
            <strong>WhatsApp:</strong> <?= htmlspecialchars($usuario['whatsapp']) ?>
        </div>
        <div class="info">
            <strong>Estado:</strong> <?= htmlspecialchars($usuario['estado']) ?>
        </div>
        <div class="info">
            <strong>Cidade:</strong> <?= htmlspecialchars($usuario['cidade']) ?>
        </div>
        
        
        <div id="registrar">
            <a href="../../Paginas/entrar.html" class="btn btn-primary">Sair</a>
            <a href="editar.php" class="btn btn-primary">Editar Perfil</a>
            <form action="delete.php" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar sua conta?');">
                <button type="submit">Deletar</button>
            </form>
        </div>
        
    </div>


    <footer>
    <div class="footer-coluna" id="cl1">
      <h2>Peludinhos do bem</h2>
      <p>08989-8989898</p>
      <p>Rua Santa Helena, 21, Parque Alvorada, Imperatriz - MA, CEP 65919-505</p>
      <p>adotefacil@peludinhosdobem.org</p>
    </div>
    <div class="footer-coluna" id="cl2">
      <a href="../sobre.html">
        <h2>Conheça a História da Peludinhos do Bem</h2>
      </a>
    </div>
    <div class="footer-coluna" id="cl3">
      <div class="app-link">
        <p>DISPONÍVEL NA</p>
        <a href="https://play.google.com/store/">
          <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" style="height: 40px;">
        </a>
      </div>
      <div class="app-link">
        <p>AVAIBLE ON THE</p>
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
