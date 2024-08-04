<?php
require_once './auxi/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmSenha = trim($_POST['confirmSenha']);
    $cpf = trim($_POST['cpf']);

    if ($senha === $confirmSenha) {
        try {
            global $UsuarioSenha;
            $select = "SELECT * FROM clientes WHERE email = :email AND cpf = :cpf";
            $parametro = $UsuarioSenha->prepare($select);
            $parametro->bindParam(':email', $email);
            $parametro->bindParam(':cpf', $cpf);
            $parametro->execute();

            if ($parametro->rowCount() > 0) {
                $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
                $update = "UPDATE clientes SET senha = :senha WHERE email = :email";
                $parametro1 = $UsuarioSenha->prepare($update);
                $parametro1->bindParam(':senha', $senhaHash);
                $parametro1->bindParam(':email', $email);

                if ($parametro1->execute()) {
                    echo "<script>alert('Sua senha foi redefinida'); window.location.href='login.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Erro ao atualizar a senha.'); window.location.href='esqueceu-senha.php';</script>";
                }
            } else {
                echo "<script>alert('Usuário não encontrado.'); window.location.href='esqueceu-senha.php';</script>";
            }
        } catch (PDOException $e) {
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<script>alert('As senhas não coincidem.'); window.location.href='esqueceu-senha.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/esqueceuSenha.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/2.png" id="esquerda" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/cachorro.png" id="direita" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <a href="login.php" id="botaoVoltar">
            <i class="bi bi-x-circle-fill"></i>
        </a>
        <div class="login-box">
            <h1>Redefinir Senha</h1>
            <form id="loginForm" method="POST" action="">
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" minlength="14" maxlength="14" required>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Nova Senha:</label>
                    <input type="password" id="senha" name="senha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const togglePassword = document.querySelector('#mostrarSenha');
                        const password = document.querySelector('#senha');
                        console.log('togglePassword:', togglePassword);
                        console.log('password:', password);
                        if (togglePassword && password) {
                            togglePassword.addEventListener('click', function() {
                                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                password.setAttribute('type', type);
                            });
                        }
                        const toggleConfirmPassword = document.querySelector('#mostrarConfirmSenha');
                        const confirmPassword = document.querySelector('#confirmSenha');
                        console.log('toggleConfirmPassword:', toggleConfirmPassword);
                        console.log('confirmPassword:', confirmPassword);
                        if (toggleConfirmPassword && confirmPassword) {
                            toggleConfirmPassword.addEventListener('click', function() {
                                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                                confirmPassword.setAttribute('type', type);
                            });
                        }
                    });
                </script>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Enviar<span></span></button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/js/senhaToggle.js"></script>
    <script src="./assets/js/mascaras.js"></script>
    <script src="./assets/js/login.js"></script>
</body>

</html>