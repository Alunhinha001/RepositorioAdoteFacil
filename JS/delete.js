function deletar() {
    const confirmar = confirm("Você realmente deseja apagar o seu perfil? Esta ação não poderá ser desfeita.");
    if (confirmar) {
        window.location.href = "/PHP/UsuarioPhp/delete.php";
    } else {
        alert("A exclusão do perfil foi cancelada.");
    }
}
