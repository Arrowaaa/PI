<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raio-X - Ven't qui</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/principal.css">
</head>

<body>
    <header>
        <nav class="menu-perfil">
            <img src="assets/img/logo principal.png" alt="logo da empresa" class="logo">
            <p>“Unindo amor e expertise para cuidar dos seus melhores amigos na saúde e na alegria."</p>
            <ul class="menu">
                <li><a href="index.php">Início</a></li>
                <li class="dropdown">
                    <a class="linha" href="#" class="dropbtn">Requisições &#9660;</a>
                    <div class="dropdown-content">
                        <a class="linha" href="raiox.php">Raio-X</a>
                        <a href="internacao.php">Internação</a>
                    </div>
                </li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li class="icon"><a href="login.php"><i class="bi bi-person"> Login</i></a></li>
            </ul>
        </nav>
    </header>

    <main style="display:flex; align-items: center;">
        <section class="container mt-5">
            <div class="box">
                <form>
                    <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>
                    <h1>Preencha Seus Dados Do Raio-X</h1>
                    <br>

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" placeholder="Digite seu Nome" name="nome">
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf">
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="number" class="form-control" id="telefone" placeholder="Digite seu número" name="numerotelefonico">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" placeholder="Digite Seu Email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gênero:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" value="M" id="m">
                            <label class="form-check-label" for="m">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" value="F" id="f">
                            <label class="form-check-label" for="f">Feminino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" value="O" id="o">
                            <label class="form-check-label" for="o">Outros</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" placeholder="Digite seu Endereço" name="endereco">
                    </div>

                    <div class="mb-3">
                        <label for="pet_nome" class="form-label">Nome do Pet:</label>
                        <input type="text" class="form-control" id="pet_nome" placeholder="Digite o Nome do Pet" name="pet_nome">
                    </div>

                    <div class="mb-3">
                        <label for="pet_especie" class="form-label">Espécie do Pet:</label>
                        <input type="text" class="form-control" id="pet_especie" placeholder="Digite a Espécie do Pet" name="pet_especie">
                    </div>

                    <div class="mb-3">
                        <label for="pet_raca" class="form-label">Raça do Pet:</label>
                        <input type="text" class="form-control" id="pet_raca" placeholder="Digite a Raça do Pet" name="pet_raca">
                    </div>

                    <div class="mb-3">
                        <label for="pet_idade" class="form-label">Idade do Pet:</label>
                        <input type="number" class="form-control" id="pet_idade" placeholder="Digite a idade do Pet" name="pet_idade">
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <label for="sexo">Gênero do Pet: </label>
                            <select id="sexo" name="sexo" required>
                                <option></option>
                                <option value="m">Macho</option>
                                <option value="f">Fêmea</option>
                                <option value="o">Outros</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sintomas" class="form-label">Sintomas ou Razão do Exame:</label>
                        <textarea class="form-control" id="sintomas" name="sintomas" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="historico_medico" class="form-label">Histórico Médico:</label>
                        <textarea class="form-control" id="historico_medico" name="historico_medico" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="preferencia_data_hora" class="form-label">Preferência de Data e Hora:</label>
                        <input type="datetime-local" class="form-control" id="preferencia_data_hora" name="preferencia_data_hora">
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Deixe sua mensagem:</label>
                        <textarea class="form-control" id="mensagem" name="texto" cols="30" rows="3"></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary"> <br>
                </form>
            </div>
        </section>
    </main>
    <br>
    <footer class="rodape">
        <main class="container">
            <div class="row">
                <div class="col md-4 text-center">
                    <h5 class="font-weight-bold">MENU</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="./servicos.php">Serviços</a></li>
                        <li><a href="./sobre.php">Sobre</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold">Sobre a Gente</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="#">Rua: Germano Giusti, 26 - Jd. Paulista - Americana - SP</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold">Nossas Redes Sociais</h5>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-youtube"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy;2024. Este site foi desenvolvido como projeto integrador (PI) - SENAC Americana.<br>
                    Não reservamos os direitos e valores apresentados são meramente ilustrativos para fins educacionais.</p>
            </div>
        </main>
    </footer>
</body>

</html>
