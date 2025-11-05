<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $peso = $_POST['peso'];
    $idade = $_POST['idade'];
    $especie = $_POST['especie'];
    $porte = $_POST['porte'];
    $raca = $_POST['raca'];
    $localidade = $_POST['local'];
    $sobre = $_POST['sobre'];

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $pasta = "imagensPet/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nomeFoto = uniqid() . "-" . basename($_FILES["foto"]["name"]);
        $caminhoFoto = $pasta . $nomeFoto;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoFoto)) {
            $foto = $caminhoFoto;
        } else {
            echo "Erro ao fazer upload da foto.";
            exit;
        }
    } else {
        $foto = null;
    } 

    try {
        $sql = "INSERT INTO pet 
                (nome, genero, peso, idade, especie, porte, raca, localidade, sobrePet, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $inserir = $conn->prepare($sql);
        $inserir->execute([$nome, $genero, $peso, $idade, $especie, $porte, $raca, $localidade, $sobre, $foto]);

        header("Location: ../index.html");
        exit;

    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
}
?>