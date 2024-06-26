<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/esqueceuSenha.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/2.png" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/cachorro.png" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <h2>Redefinir Senha</h2>
        <form id="loginForm" action="login.php">
            <div class="input-group">
                <label for="usuario">Usúario:</label>
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
                <button type="submit" class="button">Enviar</button>
            </div>
            <div class="button-group">
                <a href="login.php" class="button">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>
