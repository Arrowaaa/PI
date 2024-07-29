<?php
require_once './classe/pessoas.php';
require_once './auxi/config.php';

$id_alterar = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
$dadosUsuario = [];


if (!empty($id_alterar)) {
    $dadosUsuario = $usuario->Usuarios($id_alterar);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pet</title>
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
        <a href="<?= isset($id_alterar) ? 'perfil.php?id_cliente=' . $id_alterar : 'perfil.php?id_cliente=' . $id_cliente ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
            <h2>Cadastro de Pet</h2><br>
            <form id="cadastroForm" action="./auxi/auxcadastropet.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?= isset($id_alterar) ? $id_alterar : '' ?>">

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" <?= isset($id_alterar) ? 'readonly' : '' ?> required>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>

                <div class="input-group">
                    <label for="nomePet">Nome do Pet:</label>
                    <input type="text" id="nomePet" name="nomePet" required>
                </div>
                <div class="input-group">
                    <label for="especiePet">Espécie do Pet:</label>
                    <input type="text" id="especiePet" name="especiePet" required>
                </div>
                <div class="input-group">
                    <label for="sexoPet">Sexo do Pet:</label>
                    <select id="sexoPet" name="sexoPet" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="racaPet">Raça do Pet:</label>
                    <input type="text" id="racaPet" name="racaPet" required>
                </div>
                <div class="input-group">
                    <label for="pesoPet">Peso do Pet:</label>
                    <input type="text" id="pesoPet" name="pesoPet" required>
                </div>
                <div class="input-group">
                    <label for="porte">Porte do Pet:</label>
                    <input type="text" id="porte" name="porte" required>
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