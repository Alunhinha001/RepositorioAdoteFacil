<?php
session_start();
require '../conexao.php';

// Verifica sessão
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Sessão expirada! Faça login novamente.'); window.location.href='../../Paginas/entrar.html';</script>";
    exit;
}

$id = $_SESSION['usuario_id'];

// Buscar a foto antes de apagar
$sqlFoto = "SELECT foto FROM cliente WHERE id_cliente = ?";
$stmtFoto = $conexao->prepare($sqlFoto);
$stmtFoto->bind_param("i", $id);
$stmtFoto->execute();
$resultFoto = $stmtFoto->get_result();

if ($resultFoto->num_rows > 0) {
    $foto = $resultFoto->fetch_assoc()['foto'];
    $caminhoFoto = "../../IMG/usuario/" . $foto;

    if (file_exists($caminhoFoto) && is_file($caminhoFoto)) {
        unlink($caminhoFoto); // Apaga a foto
    }
}

// Excluir usuário do banco
$sql = "DELETE FROM cliente WHERE id_cliente = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    session_unset();
    session_destroy();

    echo "<script>
            alert('Conta deletada com sucesso.');
            window.location.href='../../Paginas/entrar.html';
          </script>";
    exit;

} else {
    echo "<script>
            alert('Erro ao deletar conta.');
            window.location.href='../Paginas/perfil.php';
          </script>";
    exit;
}
?>
