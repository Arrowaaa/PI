<?php include './includes/header.php' ?>

    <main style="display:flex; align-items: center;">
        <section class="container mt-5">
            <div class="boxx">
                <form>
                    <h1>Preencha Seus Dados Da Internação</h1>
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
                        <label class="form-label">Gênero:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" value="M" id="m">
                            <label class="form-check-label" for="m">Masculino</label>
                        </div><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" value="F" id="f">
                            <label class="form-check-label" for="f">Feminino</label>
                        </div><br>
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
                        <label for="motivo_internacao" class="form-label">Motivo da Internação:</label>
                        <textarea class="form-control" id="motivo_internacao" name="motivo_internacao" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="historico_medico" class="form-label">Histórico Médico:</label>
                        <textarea class="form-control" id="historico_medico" name="historico_medico" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="medicacoes" class="form-label">Medicações Atuais:</label>
                        <textarea class="form-control" id="medicacoes" name="medicacoes" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="alergias" class="form-label">Alergias:</label>
                        <textarea class="form-control" id="alergias" name="alergias" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contato_emergencia" class="form-label">Contato de Emergência:</label>
                        <input type="text" class="form-control" id="contato_emergencia" placeholder="Nome do Contato" name="contato_emergencia">
                        <input type="number" class="form-control mt-2" id="contato_telefone" placeholder="Telefone do Contato" name="contato_telefone">
                    </div>

                    <div class="mb-3">
                        <label for="preferencia_data_hora" class="form-label">Preferência de Data e Hora:</label>
                        <input type="datetime-local" class="form-control" id="preferencia_data_hora" name="preferencia_data_hora">
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem:</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" cols="30" rows="5" placeholder="Deixe uma mensagem"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="estado_saude" class="form-label">Estado de Saúde Atual:</label>
                        <textarea class="form-control" id="estado_saude" name="estado_saude" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="alimentacao" class="form-label">Alimentação:</label>
                        <textarea class="form-control" id="alimentacao" name="alimentacao" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="medicacao_previa" class="form-label">Medicação Prévia:</label>
                        <textarea class="form-control" id="medicacao_previa" name="medicacao_previa" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="necessidades_especiais" class="form-label">Necessidades Especiais ou Cuidados Específicos:</label>
                        <textarea class="form-control" id="necessidades_especiais" name="necessidades_especiais" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="autorizacao_procedimentos" name="autorizacao_procedimentos">
                        <label class="form-check-label" for="autorizacao_procedimentos">Autorizo a realização de procedimentos adicionais, se necessário.</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </section>
    </main> <br>

    <?php include './includes/footer.php' ?>

