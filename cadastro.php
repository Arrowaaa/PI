<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente & Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/3.png" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/2.png" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <h2>Cadastro de Cliente & Pet</h2> <br>
        <form id="cadastroForm" action="processar_cadastro.php" method="POST">
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
                <label for="sexo">Sexo do Tutor:</label>
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
                <label for="especie">Espécie do Pet:</label>
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
                <label for="sexop">Sexo do Pet:</label>
                <select id="sexop" name="sexop" required>
                    <option></option>
                    <option value="m">Macho</option>
                    <option value="f">Femea</option>
                    <option value="o">Outros</option>
                </select>
            </div>
            <div class="input-group">
                <label for="porte">Porte do Pet:</label>
                <select id="porte" name="porte" required>
                    <option></option>
                    <option value="pequeno">Pequeno</option>
                    <option value="medio">Médio</option>
                    <option value="grande">Grande</option>
                </select>
            </div>
            <div class="input-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" required>
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
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <button type="button" id="mostrarSenha"></button>
            </div>
            <div class="input-group">
                <label for="inputsenha">Insira a senha novamente:</label>
                <input type="password" id="confirmSenha" name="inputsenha" required>
                <button type="button" id="mostrarConfirmSenha"></button>
            </div>
            <button type="submit" class="button">Cadastrar</button>
        </form>

        <div>
            <p></p><a href="login.php" class="button">Voltar para Login</a>
        </div>
    </div>

    <script src="assets/js/mascaras.js"></script>
   
</body>
</html>
