<?php
session_start();
require_once './classe/Usuarios.php';
$usuario = new Usuarios();

if (!isset($_SESSION['id_cliente'])) {
    header('Location: login.php');
    exit();
}

$id_alterar = $_SESSION['id_cliente'];
$dadosUsuario = [];
$dadosPet = [];
if (!empty($id_alterar)) {
    $dadosUsuario = $usuario->Usuarios($id_alterar);
    $dadosPet = $usuario->listarPet($id_alterar);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente & Pet</title>
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
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <h2>Alterar Dados</h2><br>
            <form id="cadastroForm" action="./auxi/edicaoCliente.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($id_alterar) ?>">

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" <?= isset($id_alterar) ? 'readonly' : '' ?> required>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" minlength="14" maxlength="14" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>" minlength="14" maxlength="14" required>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" minlength="6" maxlength="8" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>
                <?php if (isset($id_alterar)) : ?>

                    <div class="input-group">
                        <label for="nome">Nome do Tutor:</label>
                        <input type="text" id="nome" name="nome" value="<?= isset($dadosUsuario['nome']) ? htmlspecialchars($dadosUsuario['nome']) : '' ?>" minlength="3" maxlength="40" required>
                    </div>
                    <div class="input-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" placeholder="(00) 0 0000-0000" value="<?= isset($dadosUsuario['telefone']) ? htmlspecialchars($dadosUsuario['telefone']) : '' ?>" minlength="15" maxlength="15">
                    </div>
                    <div class="input-group">
                        <label for="contato">Outro contato:</label>
                        <input type="text" id="contato" name="contato" placeholder="(00) 0 0000-0000" value="<?= isset($dadosUsuario['contato']) ? htmlspecialchars($dadosUsuario['contato']) : '' ?>" minlength="15" maxlength="15">
                    </div>
                    <div class="input-group">
                        <label for="sexo">Sexo do Tutor:</label>
                        <select id="sexo" name="sexo">
                            <option value=""></option>
                            <option value="M" <?= (isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] == 'M') ? 'selected' : '' ?>>Masculino</option>
                            <option value="F" <?= (isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] == 'F') ? 'selected' : '' ?>>Feminino</option>
                            <option value="O" <?= (isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] == '0') ? 'selected' : '' ?>>Outros</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="CEP">CEP:</label>
                        <input type="text" id="CEP" name="CEP" value="<?= isset($dadosUsuario['CEP']) ? htmlspecialchars($dadosUsuario['CEP']) : '' ?>" minlength="10" maxlength="10">
                    </div>
                    <div class="input-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" value="<?= isset($dadosUsuario['cidade']) ? htmlspecialchars($dadosUsuario['cidade']) : '' ?>">
                    </div>
                    <div class="input-group">
                        <label for="complemento">Complemento:</label>
                        <input type="text" id="complemento" name="complemento" value="<?= isset($dadosUsuario['complemento']) ? htmlspecialchars($dadosUsuario['complemento']) : '' ?>" minlength="8" maxlength="8">
                    </div>
                    <div class="input-group">
                        <label for="numero_residencia">Número de residência:</label>
                        <input type="text" id="numero_residencia" name="numero_residencia" value="<?= isset($dadosUsuario['numero_residencia']) ? htmlspecialchars($dadosUsuario['numero_residencia']) : '' ?>" minlength="3" maxlength="3">
                    </div>
                    <div class="input-group">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <option value="">Selecione o estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                <?php endif; ?>
                <center>
                    <button type="submit" class="button-link">Alterar <span></span></button>
                </center>
            </form>
        </div>
    </div>
    <script src="./assets/js/mascaras.js"></script>
    <script src="./assets/js/senhaToggle.js"></script>
</body>

</html>