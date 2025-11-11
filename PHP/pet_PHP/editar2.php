<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('/PHP/conexao.php');
$sql = "SELECT * FROM pet";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Pets - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/padrao.css">
    <script src="../../JS/index.js" defer></script>
</head>
<body>
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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Genero</th>
                <th>Peso</th>
                <th>Idade</th>
                <th>Especie</th>
                <th>Porte</th>
                <th>Raça</th>
                <th>Localização</th>
                <th>Descrição</th>
                <th>Foto do Pet</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($pets) > 0): ?>
            <?php foreach($pets as $pet): ?>
                <tr>
                    <td><?php echo $pet['id']; ?></td>
                    <td><?php echo $pet['nome']; ?></td>
                    <td><?php echo $pet['genero']; ?></td>
                    <td><?php echo $pet['peso']; ?></td>
                    <td><?php echo $pet['idade']; ?></td>
                    <td><?php echo $pet['especie']; ?></td>
                    <td><?php echo $pet['porte']; ?></td>
                    <td><?php echo $pet['raca']; ?></td>
                    <td><?php echo $pet['localidade']; ?></td>
                    <td><?php echo $pet['sobrePet']; ?></td>
                    <td><?php echo $pet['foto']; ?></td>
                    <td>
                        <a href="editando.php?id=<?php echo $pet['id']; ?>">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum Pet Cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="../../index.html">Voltar</a>
    <footer>
    <div class="footer-coluna" id="cl1">
      <h2>Peludinhos do bem</h2>
      <p>08989-8989898</p>
      <p>Rua Santa Helena, 21, Parque Alvorada, Imperatriz - MA, CEP 65919-505</p>
      <p>adotefacil@peludinhosdobem.org</p>
    </div>
    <div class="footer-coluna" id="cl2">
      <a href="sobre.html">
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