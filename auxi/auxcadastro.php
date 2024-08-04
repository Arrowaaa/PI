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
                echo "<script>alert('Usuário cadastrado com sucesso!!');</script>";
                echo '<script>setTimeout(function() { window.location.href = "login.php"; },);</script>';  
            } elseif ($resultado === "Usuário já existe") {
                echo "<script>alert('Usuário já existe!!');</script>";
                echo '<script>setTimeout(function() { window.location.href = "../cadastro.php"; },);</script>';
            } else {
                echo '<div class="alert alert-danger">' . $resultado . '</div>';
            }
        } else {
            echo "<script>alert('As senhas não coincidem!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "../cadastro.php"; },);</script>';
        }
    }
}
?>
