<?php
include('../PHP/conexao.php'); // Supondo que este arquivo já estabelece a conexão mysqli

$sql = "SELECT * FROM pet ORDER BY id_pet DESC";
$result = mysqli_query($conexao, $sql);

if ($result) {
    $pet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result); // Libera a memória do resultado
} else {
    echo "Erro na consulta: " . mysqli_error($conexao);
    $pet = array(); // Array vazio em caso de erro
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adote Fácil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/padrao.css" />
  <link rel="stylesheet" href="../CSS/adote.css" />
  <script src="../JS/adote.js" defer></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.html"><img src="../IMG/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
                
            </div>
            <div class="dropdown">
                <input type="checkbox" id="burger-menu">
                <label class="burger" for="burger-menu">
                <span></span>
                <span></span>
                <span></span>
                </label>

                <div class="dropdown-content">
                <a href="../index.html">Início</a>
                <a href="sobre.html">Sobre Nós</a>
                <a href="adote.php" id="adote">Adote um pet</a>
                <a href="comoajudar.html">Como ajudar</a>
                <a href="entrar.html">Entrar</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="intro-adote">
            <h1>Encontre seu novo melhor amigo</h1>
            <p>Adotar é um gesto de amor. Veja os pets disponíveis e transforme uma vida.</p>
        </section>
    <?php if (count($pet) > 0): ?>
    <div class="vitrine">
        <?php foreach ($pet as $animal): ?>
            <div class="pet-card">
                <div class="pet-imagem">
                    <img src="../IMG/adote/<?= htmlspecialchars($animal['foto'])?>" alt="cachorrinho fofo" />
                </div>
                <div class="pet-info">
                    <h2>Nome: <?php echo $animal['nome']; ?></h2>
                    <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                    <p><strong>Gênero:</strong> <?php echo $animal['genero']; ?></p>
                    <p><strong>Local:</strong> <?php echo $animal['localidade']; ?></p>
                </div>
                <div class="sobre">
                    <p><strong>Peso:</strong> <?php echo $animal['peso']; ?>kg</p>
                    <p><strong>Espécie:</strong> <?php echo $animal['especie']; ?></p>
                    <p><strong>Porte:</strong> <?php echo $animal['porte']; ?></p>
                    <p><strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                    <p><strong>Sobre pet:</strong> <?php echo $animal['sobrePet']; ?></p>
                    <a href="entrar.html"><button class="qadot">Quero adotar</button></a>
                </div>
                <button class="saiba">Saber mais</button>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum usuario cadastrado.</p>
        <?php endif; ?>
        </div>
            <div class="cadastro-pet-container">
                <a href="cadastropet.html" class="cadastro-pet-btn">Quero cadastrar meu pet</a>
            </div>
    </main>
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