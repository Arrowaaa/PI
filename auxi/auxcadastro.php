<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../classe/Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarios = new Usuarios();

    // Verifica se é um cadastro
    if (!isset($_POST['id_para_alterar']) || empty($_POST['id_para_alterar'])) {
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $confirmSenha = $_POST['confirmSenha'];

        if ($senha === $confirmSenha) {
            $resultado = $usuarios->CadastroCliente($email, $cpf, $senha, $confirmSenha);

            if ($resultado === "Usuário cadastrado com sucesso!!") {
                echo '<div class="alert alert-success">Usuário cadastrado com sucesso!!</div>';
                echo '<script>';
                echo 'setTimeout(function() { window.location.href = "login.php"; }, 1600);';
                echo '</script>';
            } elseif ($resultado === "Usuário já existe") {
                echo '<div class="alert alert-danger">Usuário já existe!!</div>';
                echo '<script>';
                echo 'setTimeout(function() { window.location.href = "criar-usuario.php?erro=usuario_existe"; }, 1600);';
                echo '</script>';
            } else {
                echo '<div class="alert alert-danger">' . $resultado . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger">As senhas não coincidem!!</div>';
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "criar-usuario.php?erro=senhas_nao_iguais"; }, 1600);';
            echo '</script>';
        }
    }
}
?>
