<?php
include('conexao.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM pet WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Usuario nao encontrado.";
        exit;
    }
} else{
    echo "ID de usuario nao fornecido.";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()){
        echo "Usuario atualizado com sucesso";
        header("Location: consulta.php");
        exit;
    } else{
        echo "Erro ao atualizar o usuario";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar as Informações do Pet</h1>
    <form method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($pet['nome']);?>" required>

        <label for="email">Genero: </label>
        <input type="genero" name="genero" id="genero" value="<?php echo htmlspecialchars($pet['genero']);?>" required>

        <label for="peso">Peso(kg): </label>
        <input type="number" name="peso" id="peso" value="<?php echo htmlspecialchars($pet['peso']);?>" required>

        <label for="idade">Idade aproximada(anos): </label>
        <input type="number" name="idade" id="idade" value="<?php echo htmlspecialchars($pet['idade']);?>" required>

        <label for="especie">Espécie: </label>
        <input type="text" name="especie" id="especie" value="<?php echo htmlspecialchars($pet['especie']);?>" required>

        <label for="porte">Porte: </label>
        <input type="text" name="porte" id="porte" value="<?php echo htmlspecialchars($pet['porte']);?>" required>

        <label for="raca">Raça: </label>
        <input type="text" name="raca" id="raca" value="<?php echo htmlspecialchars($pet['raca']);?>" required>

        <label for="local">Local: </label>
        <input type="text" name="local" id="local" value="<?php echo htmlspecialchars($pet['local']);?>" required>

        <label for="sobrePet">Sobre o Pet: </label>
        <input type="text" name="sobrePet" id="sobrePet" value="<?php echo htmlspecialchars($pet['sobrePet']);?>" required>

        <label for="foto">Atualize a foto: </label>
        <input type="text" name="foto" id="foto" value="<?php echo htmlspecialchars($pet['foto']);?>" required>

        <input type="submit" value="Atualizar">
    </form>
    <a href="consulta.php">Voltar</a>
</body>
</html>