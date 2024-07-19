<?php
require_once './classe/Usuarios.php';
$usuario = new Usuarios();
$id_alterar = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
                <i class="bi bi-arrow-left-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <input type="hidden" name="id_para_alterar" value="<?= isset($id_alterar) ? htmlspecialchars($dadosUsuario['id_cliente']) : '' ?>">
            <h2><?= isset($id_alterar) ? 'Alterar Dados' : 'Cadastro de Cliente & Pet' ?></h2><br>
            <form id="cadastroForm" action="./auxi/auxcadastro.php" method="POST">
                <div class="input-group">
                    <label for="nome">Nome do Tutor:</label>
                    <input type="text" id="nome" name="nome" value="<?= isset($dadosUsuario['nome']) ? htmlspecialchars($dadosUsuario['nome']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" <?= isset($id_alterar) ? 'readonly' : '' ?> required>
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" placeholder="(00) 0 0000-0000" value="<?= isset($dadosUsuario['telefone']) ? htmlspecialchars($dadosUsuario['telefone']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="contato">Outro contato:</label>
                    <input type="text" id="contato" name="contato" placeholder="(00) 0 0000-0000" value="<?= isset($dadosUsuario['contato']) ? htmlspecialchars($dadosUsuario['contato']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo do Tutor:</label>
                    <select id="sexo" name="sexo" required>
                        <option value=""></option>
                        <option value="M" <?= isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] === 'M' ? 'selected' : '' ?>>Masculino</option>
                        <option value="F" <?= isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] === 'F' ? 'selected' : '' ?>>Feminino</option>
                        <option value="O" <?= isset($dadosUsuario['sexo']) && $dadosUsuario['sexo'] === 'O' ? 'selected' : '' ?>>Outros</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="nomep">Nome do Pet:</label>
                    <input type="text" id="nomep" name="nomep" value="<?= isset($dadosPet['nomep']) ? htmlspecialchars($dadosPet['nomep']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="data_nascimento">Idade do Pet:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="<?= isset($dadosPet['data_nascimento']) ? htmlspecialchars($dadosPet['data_nascimento']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="especie">Espécie do Pet:</label>
                    <select id="especie" name="especie" required>
                        <option value=""></option>
                        <option value="1" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 1 ? 'selected' : '' ?>>Mamíferos</option>
                        <option value="2" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 2 ? 'selected' : '' ?>>Canidaes(Cães)</option>
                        <option value="3" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 3 ? 'selected' : '' ?>>Felídeos(Gatos)</option>
                        <option value="4" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 4 ? 'selected' : '' ?>>Neornithes(Aves)</option>
                        <option value="5" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 5 ? 'selected' : '' ?>>Peixes</option>
                        <option value="6" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 6 ? 'selected' : '' ?>>Invertebrados</option>
                        <option value="7" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 7 ? 'selected' : '' ?>>Répteis</option>
                        <option value="8" <?= isset($dadosPet['especie']) && $dadosPet['especie'] == 8 ? 'selected' : '' ?>>Anfíbios</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="raca">Raça do Pet:</label>
                    <input type="text" id="raca" name="raca" value="<?= isset($dadosPet['raca']) ? htmlspecialchars($dadosPet['raca']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="peso">Peso do Pet:</label>
                    <input type="number" id="peso" name="peso" step="0.01" value="<?= isset($dadosPet['peso']) ? htmlspecialchars($dadosPet['peso']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="sexop">Sexo do Pet:</label>
                    <select id="sexop" name="sexop" required>
                        <option value=""></option>
                        <option value="M" <?= isset($dadosPet['sexop']) && $dadosPet['sexop'] === 'M' ? 'selected' : '' ?>>Macho</option>
                        <option value="F" <?= isset($dadosPet['sexop']) && $dadosPet['sexop'] === 'F' ? 'selected' : '' ?>>Fêmea</option>
                        <option value="O" <?= isset($dadosPet['sexop']) && $dadosPet['sexop'] === 'O' ? 'selected' : '' ?>>Outros</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="porte">Porte do Pet: </label>
                    <select id="porte" name="porte" required>
                        <option value=""></option>
                        <option value="pequeno" <?= isset($dadosPet['porte']) && $dadosPet['porte'] === 'pequeno' ? 'selected' : '' ?>>Pequeno</option>
                        <option value="medio" <?= isset($dadosPet['porte']) && $dadosPet['porte'] === 'medio' ? 'selected' : '' ?>>Médio</option>
                        <option value="grande" <?= isset($dadosPet['porte']) && $dadosPet['porte'] === 'grande' ? 'selected' : '' ?>>Grande</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="">Selecione um estado</option>
                        <option value="AC" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'AC' ? 'selected' : '' ?>>Acre</option>
                        <option value="AL" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'AL' ? 'selected' : '' ?>>Alagoas</option>
                        <option value="AP" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'AP' ? 'selected' : '' ?>>Amapá</option>
                        <option value="AM" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'AM' ? 'selected' : '' ?>>Amazonas</option>
                        <option value="BA" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'BA' ? 'selected' : '' ?>>Bahia</option>
                        <option value="CE" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'CE' ? 'selected' : '' ?>>Ceará</option>
                        <option value="DF" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
                        <option value="ES" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
                        <option value="GO" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'GO' ? 'selected' : '' ?>>Goiás</option>
                        <option value="MA" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'MA' ? 'selected' : '' ?>>Maranhão</option>
                        <option value="MT" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
                        <option value="MS" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
                        <option value="PA" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'PA' ? 'selected' : '' ?>>Pará</option>
                        <option value="PB" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'PB' ? 'selected' : '' ?>>Paraíba</option>
                        <option value="PR" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'PR' ? 'selected' : '' ?>>Paraná</option>
                        <option value="PE" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'PE' ? 'selected' : '' ?>>Pernambuco</option>
                        <option value="PI" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'PI' ? 'selected' : '' ?>>Piauí</option>
                        <option value="RJ" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
                        <option value="RN" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'RO' ? 'selected' : '' ?>>Rondônia</option>
                        <option value="RR" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'RR' ? 'selected' : '' ?>>Roraima</option>
                        <option value="SC" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
                        <option value="SP" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'SP' ? 'selected' : '' ?>>São Paulo</option>
                        <option value="SE" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'SE' ? 'selected' : '' ?>>Sergipe</option>
                        <option value="TO" <?= isset($dadosUsuario['estado']) && $dadosUsuario['estado'] === 'TO' ? 'selected' : '' ?>>Tocantins</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="cidade">Cidade: </label>
                    <input type="text" id="cidade" name="cidade" value="<?= isset($dadosUsuario['cidade']) ? htmlspecialchars($dadosUsuario['cidade']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="<?= isset($dadosUsuario['complemento']) ? htmlspecialchars($dadosUsuario['complemento']) : '' ?>" required>
                </div>
                <div class="input-group">
                    <label for="numero_residencia">Número (Residência): </label>
                    <input type="number" id="numero_residencia" name="numero_residencia" value="<?= isset($dadosUsuario['numero_residencia']) ? htmlspecialchars($dadosUsuario['numero_residencia']) : '' ?>" required>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" <?= isset($id_alterar) ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" <?= isset($id_alterar) ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>

                <br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link"><?= isset($id_alterar) ? 'Alterar' : 'Cadastrar' ?><span></span></button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/mascaras.js"></script>
    <script src="assets/js/senhaToggle.js"></script>
</body>

</html>