<!-- 
<?php
include('conexao.php');
$sql = "SELECT * FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="/css/editar2.css">
</head>
<body>
    <h1>Lista de Usuarios Cadastrados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- <?php if(count($usuarios) > 0): ?> -->
            <!-- <?php foreach($usuarios as $usuario): ?> -->
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    </td>
                </tr>
                <!-- <?php endforeach; ?> -->
            <!-- <?php else: ?> -->
                <tr>
                    <td colspan="4">Nenhum Usuario Cadastrado.</td>
                </tr>
            <!-- <?php endif; ?> -->
        </tbody>
    </table>
    <a href="../index.html">Voltar</a>
</body>
</html>