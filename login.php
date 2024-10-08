<?php
session_start(); 

require_once  './classe/Usuarios.php';
include './auxi/config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['senha']);

    try {
        global $UsuarioSenha;

        $select = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $UsuarioSenha->prepare($select);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            if ($resultado['senha'] !== null && password_verify($password, $resultado['senha'])) {
                $id_cliente = $resultado['id_cliente'];
                
                // Armazena o ID do cliente na sessão
                $_SESSION['id_cliente'] = $id_cliente;

                $message = '<p class="alert alert-success">Login bem-sucedido.</p>';
                echo '<script>';
                echo 'setTimeout(function() { window.location.href = "perfil.php"; }, 1600);';
                echo '</script>';
            } else {
                $message = '<p class="alert alert-danger">Credenciais inválidas. Tente novamente.</p>';
            }
        } else {
            $message = '<p class="alert alert-danger">Cliente não encontrado.</p>';
        }
    } catch (PDOException $e) {
        $message = 'Erro: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="imagens">
        <img src="assets/img/cachorros/cachorro.png" id="imagem-direita" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <a href="index.php" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <h1>Login</h1><br>
        <div id="alert-container">
            <?php echo $message; ?>
        </div>
        <div class="login-box">
            <form method="POST" action="#" id="loginForm" onsubmit="return validateForm()" novalidate>
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
                    <span class="error" id="emailError"></span>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <i class="forgot-password" onclick="location.href='esqueceu-senha.php'">Esqueceu a senha?</i>
                <br>
                <i id="Criaruser" onclick="location.href='cadastro.php'">Criar usuario</i>
                <br><br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Entrar <span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/js/login.js"></script>
</body>
</html>