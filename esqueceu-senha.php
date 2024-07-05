<?php

$host = '62.72.62.1';
$dbname = 'u687609827_edilson';
$username = 'u687609827_edilson';
$password = '>2Ana=]b';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = htmlspecialchars($_POST['usuario']);
    $senha = htmlspecialchars($_POST['senha']);
    $confirmSenha = htmlspecialchars($_POST['confirmSenha']);

    if ($senha === $confirmSenha) {
        try {
            $UsuarioSenha = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar se o usuário existe
            $select = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $parametro = $UsuarioSenha->prepare($select);
            $parametro->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $parametro->execute();

            if ($parametro->rowCount() > 0) {
               
                $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
                $update = "UPDATE usuarios SET senha = :senha WHERE usuario = :usuario";
                $parametro = $UsuarioSenha->prepare($update);
                $parametro->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
                $parametro->bindParam(':usuario', $usuario, PDO::PARAM_STR);

                if ($parametro->execute()) {
                    echo "<script>alert('Sua senha foi redefinida'); window.location.href='login.php';</script>";
                } else {
                    echo "Erro ao atualizar a senha.";
                }
            } else {
                echo "<p>Usuário não encontrado.</p>";
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    } else {
        echo "<p>As senhas não coincidem.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/esqueceuSenha.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/2.png" id="esquerda" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/cachorro.png" id="direita" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <a href="login.php" id="botaoVoltar">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a>
        <div class="login-box">
            <h1>Redefinir Senha</h1>
            <form id="loginForm" method="POST" action="">
                <div class="input-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Nova Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Enviar<span></span></button>
                    </center>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>