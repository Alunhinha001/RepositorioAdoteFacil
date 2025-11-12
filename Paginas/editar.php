<?php
session_start();
include 'PHP/UsuarioPhp/conexao2.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['online']) || !isset($_SESSION['idUsuario'])) {
    echo "<script>alert('Sessão expirada. Faça login novamente.'); window.location.href='entrar.html';</script>";
    exit;
}

$id_usuario = $_SESSION['idUsuario'];

// Busca os dados do usuário logado
$sql = "SELECT * FROM cliente WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($conexao, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Usuário não encontrado.");
}

$doador = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Perfil - Adote Fácil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/padrao.css" />
  <link rel="stylesheet" href="css/cadastrar.css" />
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <a href="index.html"><img src="images/Logotipo.jpg" alt="logo_Adote_Fácil" /></a>
      </div>
      <div class="dropdown">
        <input type="checkbox" id="burger-menu">
        <label class="burger" for="burger-menu">
          <span></span><span></span><span></span>
        </label>
        <div class="dropdown-content">
          <a href="../index.html">Início</a>
          <a href="sobre.html">Sobre Nós</a>
          <a href="adote.html">Adote um pet</a>
          <a href="comoajudar.html">Como ajudar</a>
          <a href="entrar.html">Entrar</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="box">
    <form action="PHP/UsuarioPhp/editar.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend><b>Reescreva as informações do Seu Perfil</b></legend>

        <div class="inputBox">
          <label for="nome" class="labelinput">Nome completo</label>
          <input type="text" name="nomeDoador" id="nome" class="inputUser"
                 value="<?= htmlspecialchars($doador['nomeCompleto']) ?>" required>
        </div>

        <div class="inputBox">
          <label for="email" class="labelinput">E-mail</label>
          <input type="email" name="email" id="email" class="inputUser"
                 value="<?= htmlspecialchars($doador['email']) ?>" required>
        </div>

        <div class="inputBox">
          <label for="telefone" class="labelinput">Telefone</label>
          <input type="tel" name="telefone" id="telefone" class="inputUser"
                 value="<?= htmlspecialchars($doador['telefone']) ?>" required>
        </div>

        <div class="inputBox">
          <label for="whats" class="labelinput">WhatsApp</label>
          <input type="tel" name="whats" id="whats" class="inputUser"
                 value="<?= htmlspecialchars($doador['whatsapp']) ?>" required>
        </div>

        <div class="scroll">
          <div class="inputBox">
            <label for="estado" class="labelinput">Estado</label>
            <select name="estado" id="estado" required>
              <option value="">Selecione um Estado</option>
              <?php
              $estados = ["AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ","RN","RO","RR","RS","SC","SE","SP","TO"];
              foreach ($estados as $uf) {
                  $sel = ($uf == $doador['estado']) ? 'selected' : '';
                  echo "<option value='$uf' $sel>$uf</option>";
              }
              ?>
            </select>
          </div>

          <div class="inputBox">
            <label for="cidade" class="labelinput">Cidade</label>
            <input type="text" name="cidade" id="cidade" class="inputUser"
                   value="<?= htmlspecialchars($doador['cidade']) ?>" required>
          </div>
        </div>

        <div class="inputBox">
          <label for="senha" class="labelinput">Senha</label>
          <input type="password" name="senha" id="senha" class="inputUser"
                 placeholder="Digite uma nova senha se quiser alterar">
        </div>

        <div class="inputBox">
          <label for="foto" class="labelinput">Foto de Perfil</label>
          <input type="file" name="foto" id="foto" accept="image/*">
          <?php if (!empty($doador['foto'])): ?>
            <p>Foto atual:</p>
            <img src="imagens/<?= htmlspecialchars($doador['foto']) ?>" alt="Foto do perfil" width="100">
          <?php endif; ?>
        </div>

        <input type="submit" value="Salvar" class="botao-salvar">
      </fieldset>
    </form>
  </div>
</body>
</html>
