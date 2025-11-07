<?php
include('conexao2.php');
session_start();

if (isset($_SESSION['idUsuario'])) {
    $id = $_SESSION['idUsuario'];

    // Usa mysqli (não PDO)
    $sql = "DELETE FROM cliente WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Usuário excluído com sucesso!";
            session_destroy();
            header("Location: ../cadastrar.html");
            exit;
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "Erro ao excluir o usuário: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    echo "ID de usuário não fornecido.";
    exit;
}
?>
