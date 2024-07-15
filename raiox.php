<?php include './includes/header.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<main>
    <section id="box">
        <div id="content">
            <form id="form">
                <h2>Preencha Seus Dados Do Raio-X</h2>
                <br>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:  </label>
                    <input type="text" class="inputUser" id="nome" name="nome">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF:  </label>
                    <input type="text" class="inputUser" id="cpf" name="cpf">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="number" class="inputUser" id="telefone" name="telefone">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:  </label>
                    <input type="email" class="inputUser" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="date">Data de Nascimento:  </label>
                    <input type="date" class="inputUser">
                </div>

                <div class="mb-3">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <input type="radio">  Masculino  </input>
                    <input type="radio">  Feminino  </input>
                    <input type="radio">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço:  </label>
                    <input type="text" class="inputUser" id="endereco" name="endereco">
                </div>

                <div class="mb-3">
                    <label for="pet_nome" class="form-label">Nome do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_nome" name="pet_nome">
                </div>

                <div class="mb-3">
                    <label for="pet_especie" class="form-label">Espécie do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_especie" name="pet_especie">
                </div>

                <div class="mb-3">
                    <label for="pet_raca" class="form-label">Raça do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_raca" name="pet_raca">
                </div>

                <div class="mb-3">
                    <label for="pet_idade">Idade do Pet:  </label>
                    <input type="number" class="inputUser" id="pet_idade" name="pet_idade">
                </div><br>

                <div class="mb-3">
                    <label for="sexopet">Sexo do Pet:  </label>
                    <input type="radio">  Macho  </input>
                    <input type="radio">  Femea  </input>
                    <input type="radio">  Outros  </input>
                </div>
                
                <div class="mb-3">
                    <label for="preferencia_data_hora" class="form-label">Preferência de Periodo:  </label>
                    <input type="radio">  Manhã  </input>
                    <input type="radio">  Tarde  </input>
                    <input type="radio">  Noite  </input>
                </div>

                <div class="mb-3">
                    <label for="sintomas" class="form-label">Sintomas ou Razão do Exame:  </label>
                    <textarea class="inputUser" id="sintomas" name="sintomas" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="historico_medico" class="form-label">Histórico Médico:  </label>
                    <textarea class="inputUser" id="historico_medico" name="historico_medico" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Deixe sua mensagem:  </label>
                    <textarea class="inputUser" id="mensagem" name="mensagem" cols="30" rows="3"></textarea>
                </div>
                <br>

                <button type="button" id="generate-pdf">Baixar Formulário</button>
            </form>
        </div>
    </section>
    <script src="./assets/js/pdf.js" defer></script>
</main><br>

<?php include './includes/footer.php' ?>