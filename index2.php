<?php
session_start();

// Se o usuário não estiver logado, volta para o index normal
if (!isset($_SESSION['online']) || $_SESSION['online'] !== true) {
  header('Location: index.html');
  exit();
}

// Define a imagem do perfil
$caminhoFoto = !empty($_SESSION['fotoUsuario']) ? $_SESSION['fotoUsuario'] : 'images/user-icon.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adote Fácil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="CSS/padrao.css">
  <link rel="stylesheet" href="CSS/index.css">
  <script src="JS/index.js" defer></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
              <a href="index2.php"><img src="images/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
            </div>
            <div class="dropdown">
                <input type="checkbox" id="burger-menu">
                <label class="burger" for="burger-menu">
                <span></span>
                <span></span>
                <span></span>
                </label>

                <div class="dropdown-content">
                <a href="index2.php" id="inicio">Início</a>
<<<<<<< HEAD
                <a href="sobre.php">Sobre Nós</a>
                <a href="adote.php">Adote um pet</a>
                <a href="comoajudar.html">Como ajudar</a>
                <a href="">Meu Perfil</a>
=======
                <a href="Paginas/sobre.html">Sobre Nós</a>
                <a href="Paginas/adote.php">Adote um pet</a>
                <a href="Paginas/comoajudar.html">Como ajudar</a>
                <a href="PHP/Usuario/perfil.php">Meu Perfil</a>
>>>>>>> 50fad32f604806600c0aab70b2c492bf076dd2ea
                </div>
            </div>
        </nav>
    </header>


	<main>
		<section class="carrossel">
            <div class="slides-container">
                <div class="slide ativo">
                <img src="IMG/index/adocao-de-caes3.jpg" alt="Slide 1">
                <div class="slide-texto">
                    <h2>Bem-vindo ao Adote Fácil</h2>
                    <p>Transforme a vida de um pet com amor e cuidado.</p>
                    <a href="adote.php" class="btn-slide">Adotar agora</a>
                </div>
                </div>
                <div class="slide">
                <img src="IMG/index/pexels-photo-141496.jpg" alt="Slide 2">
                <div class="slide-texto">
                    <h2>Ajude a nossa causa</h2>
                    <p>Doe, compartilhe ou seja voluntário. Toda ajuda importa!</p>
                    <a href="comoajudar.html" class="btn-slide">Como ajudar</a>
                </div>
                </div>
                <div class="slide">
                <img src="IMG/index/golden.jpg" alt="Slide 3">
                <div class="slide-texto">
                    <h2>Conheça nossos parceiros</h2>
                    <p>Petshops, clínicas e apoiadores que fazem a diferença.</p>
                    <a href="comoajudar.html" class="btn-slide">Ver parcerias</a>
                </div>
                </div>
            </div>
            <img src="IMG/index/Seta-esquerda.png" alt="" class="seta esquerda">
            <img src="IMG/index/setas.png" alt="" class="seta direita">
        </section>



		<section class="comunidade">
			<h1>Junte-se à Nossa Comunidade</h1>
			<p>Todos podem fazer parte dessa transformação. Seja voluntário, apoie com doações ou ajude compartilhando nossos animais. Sua atitude pode mudar uma vida.</p>
			<div class="opcoes-comunidade">
				<div class="opcao">
					<h2>Seja Voluntário</h2>
					<p>Ajude nas feirinhas, lares temporários ou redes sociais.</p>
					<button><a href="comoajudar.html">Seja um Voluntário</a></button>
				</div>
				<div class="opcao">
					<h2>&#128176; | Apoie com Doações</h2>
					<p>Sua atitude pode mudar uma vida</p>
					<button><a href="comoajudar.html">Doe Agora</a></button>
				</div>
				<div class="opcao">
					<h2>&#128227; | Compartilhe nas Redes</h2>
					<p>Divulgue um pet e aumente as chances de adoção.</p>
					<button>Divulgue</button>
				</div>
				<div class="opcao">
					<h2>&#128722; | Parcerias Locais</h2>
					<p>Tem um petshop ou clínica? Torne-se parceiro da causa.</p>
					<button><a href="comoajudar.html">Fazer parceria</a></button>
				</div>
			</div>
		</section>

		<section class="cards-vitrini">
            <h1>Conheça alguns dos animais disponiveis</h1>
			<div class="vitrine">
				<div class="pet-card">
                    <div class="pet-imagem">
                        <img src="IMG/adote/capreto.jpg" alt="cachorrinho fofo" />
                    </div>
                    <div class="pet-info">
                        <h2>Nome: thor</h2>
                        <p><strong>Idade:</strong> 3 meses</p>
                        <p><strong>Gênero:</strong> macho</p>
                        <p><strong>Local:</strong> Imperatriz-MA</p>
                    </div>
                    <div class="sobre">
                        <p><strong>Peso:</strong> 3 kg</p>
                        <p><strong>Espécie:</strong> cachorro</p>
                        <p><strong>Porte:</strong> pequeno</p>
                        <p><strong>Raça:</strong> kokoni</p>
                        <p><strong>Sobre pet:</strong> Cachorrinho muito dócil, carinhoso, brincalhão, adora brincar com bolinhas</p>
                        <a href=""><button class="qadot">Quero adotar</button></a>
                    </div>
                    <button class="saiba">Saber mais</button>
                </div>
                <div class="pet-card">
                    <div class="pet-imagem">
                        <img src="IMGadote/golden.jpg" alt="cachorrinho fofo" />
                    </div>
                    <div class="pet-info">
                        <h2>Nome: thor</h2>
                        <p><strong>Idade:</strong> 3 meses</p>
                        <p><strong>Gênero:</strong> macho</p>
                        <p><strong>Local:</strong> Imperatriz-MA</p>
                    </div>
                    <div class="sobre">
                        <p><strong>Peso:</strong> 3 kg</p>
                        <p><strong>Espécie:</strong> cachorro</p>
                        <p><strong>Porte:</strong> pequeno</p>
                        <p><strong>Raça:</strong> kokoni</p>
                        <p><strong>Sobre pet:</strong> Cachorrinho muito dócil, carinhoso, brincalhão, adora brincar com bolinhas</p>
                        <a href=""><button class="qadot">Quero adotar</button></a>
                    </div>
                    <button class="saiba">Saber mais</button>
                </div>
                <div class="pet-card">
                    <div class="pet-imagem">
                        <img src="IMG/adote/gato-siames.jpg" alt="cachorrinho fofo" />
                    </div>
                    <div class="pet-info">
                        <h2>Nome: thor</h2>
                        <p><strong>Idade:</strong> 3 meses</p>
                        <p><strong>Gênero:</strong> macho</p>
                        <p><strong>Local:</strong> Imperatriz-MA</p>
                    </div>
                    <div class="sobre">
                        <p><strong>Peso:</strong> 3 kg</p>
                        <p><strong>Espécie:</strong> cachorro</p>
                        <p><strong>Porte:</strong> pequeno</p>
                        <p><strong>Raça:</strong> kokoni</p>
                        <p><strong>Sobre pet:</strong> Cachorrinho muito dócil, carinhoso, brincalhão, adora brincar com bolinhas</p>
                        <a href=""><button class="qadot">Quero adotar</button></a>
                    </div>
                    <button class="saiba">Saber mais</button>
                </div>
                <div class="pet-card">
                    <div class="pet-imagem">
                        <img src="IMG/adote/pet 4.jpeg" alt="cachorrinho fofo" />
                    </div>
                    <div class="pet-info">
                        <h2>Nome: thor</h2>
                        <p><strong>Idade:</strong> 3 meses</p>
                        <p><strong>Gênero:</strong> macho</p>
                        <p><strong>Local:</strong> Imperatriz-MA</p>
                    </div>
                    <div class="sobre">
                        <p><strong>Peso:</strong> 3 kg</p>
                        <p><strong>Espécie:</strong> cachorro</p>
                        <p><strong>Porte:</strong> pequeno</p>
                        <p><strong>Raça:</strong> kokoni</p>
                        <p><strong>Sobre pet:</strong> Cachorrinho muito dócil, carinhoso, brincalhão, adora brincar com bolinhas</p>
                        <a href=""><button class="qadot">Quero adotar</button></a>
                    </div>
                    <button class="saiba">Saber mais</button>
                </div>
			</div>
            <nav class="vejamais">
                <a href="Paginas/adote.php">Veja mais <br><img src="IMG/index/Seta-cinza.png" alt=""></a>
            </nav>
		</section>

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