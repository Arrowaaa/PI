<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente & Pet</title>
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
            <h2><?= isset($id_alterar) ? 'Alterar Dados' : 'Cadastro de Cliente & Pet' ?></h2> <br>
            <form id="cadastroForm" action="" method="POST">
                <div class="input-group">
                    <label for="nomeTutor">Nome do Tutor:</label>
                    <input type="text" id="nomeTutor" name="tutor" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" placeholder="exemplo@exemplo.com" name="email" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" placeholder="(00) 0000-0000" name="telefone" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="contato">Outro contato:</label>
                    <input type="text" id="contato" placeholder="(00) 0000-0000" name="contato" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <select id="sexo" name="sexo" required>
                        <option></option>
                        <option value="m">Masculino</option>
                        <option value="f">Feminino</option>
                        <option value="o">Outros</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="nomePet">Nome do Pet:</label>
                    <input type="text" id="nomePet" name="paciente" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="idade">Idade do Pet:</label>
                    <input type="date" id="idade" name="idade" required>
                </div>
                <div class="input-group">
                    <label for="especie">Espécie do Pet:  </label>
                    <select type="text" id="especie" name="especie" required>
                        <option></option>
                        <option value="m">Mamíferos</option>
                        <option value="c">Canidaes(Cães)</option>
                        <option value="f">Felídeos(Gatos)</option>
                        <option value="n">Neornithes(Aves)</option>
                        <option value="p">Peixes</option>
                        <option value="i">Invertebrados</option>
                        <option value="r">Répteis</option>
                        <option value="a">Anfíbios</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="raca">Raça do Pet:</label>
                    <input type="text" id="raca" name="raca" required>
                </div>
                <div class="input-group">
                    <label for="peso">Peso do Pet:</label>
                    <input type="number" id="peso" name="peso" step="0.01" required>
                </div>
                <div class="input-group">
                    <label for="sexop">Sexo do Pet:  </label>
                    <select id="sexop" name="sexop" required>
                        <option></option>
                        <option value="m">Macho</option>
                        <option value="f">Femea</option>
                        <option value="o">Outros</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="porte">Porte do Pet:  </label>
                    <select id="porte" name="porte" required>
                        <option></option>
                        <option value="pequeno">Pequeno</option>
                        <option value="medio">Médio</option>
                        <option value="grande">Grande</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required placeholder="00000-000">
                    <script src="assets/js/mascaras.js"></script>
                </div>
                <div class="input-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="input-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento">
                </div>
                <div class="input-group">
                    <label for="Numero">Número (Residência):</label>
                    <input type="number" id="Numero" name="Numero" required>
                </div>
            </form>
            <form action="" method="POST" <?= isset($id_alterar) ? 'disabled' : '' ?>>
            <br>
            <h3>Crie Seu Usuário</h3>
            <br>
                <div class="input-group">
                    <label <?= isset($id_alterar) ? 'disabled' : '' ?> for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="input-group password-group">
                    <label for="senha">Senha:</label>
                    <input <?= isset($id_alterar) ? 'disabled' : '' ?> type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input <?= isset($id_alterar) ? 'disabled' : '' ?> type="password" id="confirmSenha" name="confirmSenha" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div><br>
                <a type="submit" class="button"><?= isset($id_alterar) ? 'Alterar' : 'Cadastrar' ?> <span></span></a>
            </form>
        </div>
    </div>

    <script src="assets/js/mascaras.js"></script>
    <script src="assets/js/senhaToggle.js"></script>

</body>

</html>