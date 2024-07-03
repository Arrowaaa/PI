<?php
include 'classe/Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['usuario'];
    $password = $_POST['senha'];
    $passwordConfirm = $_POST['confirma'];

    $usuario = new Usuarios();
    $resultado = $usuario->CadastroUsuario($user, $password, $passwordConfirm);

    if ($resultado === "Usuário cadastrado com sucesso") {
        // Redirecionar para a página de login
        header('Location: login.php');
        exit();
    } elseif ($resultado === "Usuário já existe") {
        // Redirecionar para a página de criação de usuário com mensagem de erro
        header('Location: criar-usuario.php?erro=usuario_existe');
        exit();
    } elseif ($resultado === "Senhas não são iguais") {
        // Redirecionar para a página de criação de usuário com mensagem de erro
        header('Location: criar-usuario.php?erro=senhas_nao_iguais');
        exit();
    } else {
        // Exibir mensagem de erro
        echo $resultado;
    }
}


if (!empty($_POST['id_para_alterar'])){

    $user = $_POST['usuario'];
    $password = $_POST['senha'];
    $passwordConfirm = $_POST['confirma'];
    $id_para_alterar = $_POST['id_para_alterar'];

    $usuario = new Usuarios();

    $resultado = $usuario->AtualizarUsuario($id_para_alterar, $user, $password, $passwordConfirm);


}
