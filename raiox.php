<?php include './includes/header.php' ?>

    <main style="display:flex; align-items: center;">
        <section class="container mt-5">
            <div class="boxb">
                <form>
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

                    <div class="input-group">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <select id="sexo" name="sexo" required>
                        <option></option>
                        <option value="m">Masculino</option>
                        <option value="f">Feminino</option>
                        <option value="o">Outros</option>
                    </select>
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
                            <label for="sexo">Gênero do Pet:  </label>
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
    
    <?php include './includes/footer.php' ?>

