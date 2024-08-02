<?php
require_once './classe/Usuarios.php';
$usuario = new Usuarios();
$id_alterar = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
$dadosUsuario = [];
$dadosPet = [];

if (!empty($id_alterar)) {
    $dadosUsuario = $usuario->Usuarios($id_alterar);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
</head>
<body>
    <div class="imagens">
        <img src="assets/img/cachorros/3.png" id="esquerda" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/2.png" id="direita" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <div class="login-box">
        <a href="login.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <h2>Cadastro de Cliente</h2><br>
            <form id="cadastroForm" action="./auxi/auxcadastro.php" method="POST">
                
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" <?= isset($id_alterar) ? 'readonly' : '' ?> required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" minlength="14" maxlength="14" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarSenha"></button>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                    <script src="assets/js/mascaras.js"></script>
                </div>
    
                <center>
                        <button type="submit" class="button-link">Cadastrar<span></span></button>
                </center>
            </form>
        </div>
    </div>
    <script src="./assets/js/senha.js"></script>
</body>
</html>
