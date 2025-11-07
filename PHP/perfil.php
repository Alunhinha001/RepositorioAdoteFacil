<?php
    session_start();

    if(!isset($_SESSION['online'])):
            header('Location: ../entrar.html');
    endif;

    $nome_usuario = $_SESSION['nomeUsuario'];
    $email_usuario = $_SESSION['emailUsuario'] ?? "Email não salvo na sessão";
    $senha_usuario = $_SESSION['senhaUsuario'];
    $telefone_usuario = $_SESSION['telefoneUsuario'];
    $whats_usuario = $_SESSION['whatsUsuario'];
    $estado_usuario = $_SESSION['estadoUsuario'];
    $cidade_usuario = $_SESSION['cidadeUsuario'];
    $id_usuario = $_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        :root {
            --cor-primaria: #ff7f50;
            --cor-fundo: #f8f9fa;
            --cor-card: #ffffff;
            --cor-texto: #333;
            --cor-detalhe: #e9ecef;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--cor-fundo);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: var(--cor-card);
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.8s ease-out;
        }

        h1 {
            text-align: center;
            color: var(--cor-primaria);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .info {
            background-color: var(--cor-detalhe);
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 12px;
            font-size: 16px;
            color: var(--cor-texto);
            transition: background 0.3s ease;
        }

        .info:hover {
            background-color: #ffe8df;
        }

        #registrar {
            padding-top: 10px;
        }

        .btn-sair {
            display: block;
            width: 100%;
            background-color: var(--cor-primaria);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .btn-sair:hover {
            background-color: #ff5a1f;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .perfil-container {
                padding: 30px 20px;
            }
            h1 {
                font-size: 24px;
            }
            .info {
                font-size: 15px;
            }
        }
    </style>
    <title>Perfil</title>
</head>
<body>
    <div class="container">
            <h1>Perfil do Usuário</h1>

        <div class="info">
            <strong>ID:</strong> <?= htmlspecialchars($id_usuario); ?>
        </div>
        <div class="info">
            <strong>Nome:</strong> <?= htmlspecialchars($nome_usuario); ?>
        </div>
        <div class="info">
            <strong>E-mail:</strong> <?= htmlspecialchars($email_usuario); ?>
        </div>
        <div class="info">
            <strong>Telefone:</strong> <?= htmlspecialchars($telefone_usuario); ?>
        </div>
        <div class="info">
            <strong>WhatsApp:</strong> <?= htmlspecialchars($whats_usuario); ?>
        </div>
        <div class="info">
            <strong>Estado:</strong> <?= htmlspecialchars($estado_usuario); ?>
        </div>
        <div class="info">
            <strong>Cidade:</strong> <?= htmlspecialchars($cidade_usuario); ?>
        </div>
        
        <div id="registrar">
            <a href="../entrar.html" class="btn btn-primary">Sair</a>
            <a href="../editar.html" class="btn btn-primary">Editar Perfil</a>
            <a href="delete.php?id=<?php echo $id_usuario; ?>" class="btn btn-primary">Deletar</a>
        </div>
        
    </div>
</body>
</html>
