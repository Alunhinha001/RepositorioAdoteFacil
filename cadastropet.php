<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adote Fácil - Cadastro de Pet</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../CSS/padrao.css" />
  <link rel="stylesheet" href="../CSS/cadastropet.css" />
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
      <a href="index.html"><img src="../IMG/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
      </div>
      <div class="dropdown">
        <input type="checkbox" id="burger-menu" />
        <label class="burger" for="burger-menu">
          <span></span>
          <span></span>
          <span></span>
        </label>

        <div class="dropdown-content">
          <a href="../index.html">Início</a>
          <a href="sobre.html">Sobre Nós</a>
          <a href="adote.php">Adote um pet</a>
          <a href="comoajudar.html">Como ajudar</a>
          <a href="entrar.html">Entrar</a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="boxpet">
      <form action="../PHP/PETs/cadastrarPET.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend><b>Cadastre seu Pet</b></legend>

          <div class="inputBox">
            <label for="nome" class="labelinput">Nome do Animal</label>
            <input type="text" name="nome" id="nome" class="inputUser" required />
          </div>

          <div class="inputBox">
            <label for="genero" class="labelinput">Informe o gênero do seu animal</label>
            <select name="genero" id="genero" required>
              <option value="">Selecione o gênero</option>
              <option value="Macho">Macho</option>
              <option value="Fêmea">Fêmea</option>
            </select>
          </div>

          <div class="inputBox">
            <label for="peso" class="labelinput">Peso (kg)</label>
            <input type="number" name="peso" id="peso" class="inputUser" step="0.1" min="0" required />
          </div>

          <div class="inputBox">
            <label for="idade" class="labelinput">Idade aproximada (anos)</label>
            <input type="number" name="idade" id="idade" class="inputUser" min="0" required />
          </div>

          <div class="inputBox">
            <label for="especie" class="labelinput">Espécie</label>
            <input type="text" name="especie" id="especie" class="inputUser" required />
          </div>

          <div class="inputBox">
            <label for="porte" class="labelinput">Porte</label>
            <input type="text" name="porte" id="porte" class="inputUser" required />
          </div>

          <div class="inputBox">
            <label for="raca" class="labelinput">Raça</label>
            <input type="text" name="raca" id="raca" class="inputUser" required />
          </div>

          <div class="inputBox">
            <label for="local" class="labelinput">Local</label>
            <input type="text" name="local" id="local" class="inputUser" required />
          </div>

          <div class="inputBox">
            <label for="sobre" class="labelinput">Sobre o Pet</label>
            <textarea name="sobre" id="sobre" class="inputUser" rows="4" placeholder="Conte um pouco sobre seu pet..."></textarea>
          </div>

          <div class="inputBox">
            <label for="imagem" class="labelinput">Insira uma foto do Animal</label>
            <input type="file" name="foto" id="foto" class="inputUser" accept="image/*" required>
          </div>

          <p>
            Ao clicar no botão você estará automaticamente concordando com os nossos
            <a href="#">Termo de Uso e Política de Privacidade</a> do site Adote Fácil
          </p>

          <button type="submit">Salvar</button>
        </fieldset>
      </form>
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
