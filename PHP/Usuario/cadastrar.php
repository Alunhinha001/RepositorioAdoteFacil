<?php
include "../conexao.php";
    // recebe is valores enviados via POST da página cadastro.html
    $nome = $_POST['nomeDoador'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $whatsapp = $_POST['whats'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $senha = $_POST['senha'];
    $fotoNome = $_FILES['foto']['name'];
    $fotoTemp = $_FILES['foto']['tmp_name'];
    $fotoCaminho = '../../IMG/usuario' . $fotoNome;

    move_uploaded_file($fotoTemp, $fotoCaminho);

    //inserir os valores das variáveis na tabela cliente do banco login
    $inserirSQL = "INSERT INTO cliente(nomeCompleto, email, telefone, whatsapp, estado, cidade, senha, foto) 
                    VALUES ('$nome', '$email', '$telefone', '$whatsapp', '$estado', '$cidade', '$senha', '$fotoNome')";
    //OBS: sempre que os valores forem do tipo VARCHAR, deve ficar entre 'aspas simples'

    // Verificação
    if (mysqli_query($conexao, $inserirSQL)) {
        echo "Usuário Cadastrado!";
        header('Location: ../../entrar.html');
    } else {
        echo "Usuário não cadastrado. Erro: ".mysqli_connect_error($conexao);
    }

    // Encerra a conexão para evitar travamentos no banco de dados
    mysqli_close($conexao);
?>
