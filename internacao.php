<?php include './includes/header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
<main>
<main >
    <section id="box">
        <div id="content">
            <form id="form">
                <h2>Preencha Seus Dados Da Internação</h2>
                <br>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:  </label>
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="inputUser" id="nome" name="nome">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF:  </label>
                    <input type="text" class="inputUser" id="cpf" name="cpf">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone:  </label>
                    <input type="number" class="inputUser" id="telefone" name="numerotelefonico">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:  </label>
=======
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" class="inputUser" id="cpf"  name="cpf">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="number" class="inputUser" id="telefone"  name="numerotelefonico">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="inputUser" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento:  </label>
                    <input type="date" class="inputUser" id="data_nascimento" name="data_nascimento">
                </div><br>

                <div class="mb-3">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <input type="checkbox">  Masculino  </input>
                    <input type="checkbox">  Feminino  </input>
                    <input type="checkbox">  Outros  </input>
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
                    <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                    <input type="date" class="inputUser" id="data_nascimento" name="data_nascimento">
                </div>

                <div class="mb-3">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <input type="radio">  Masculino  </input>
                    <input type="radio">  Feminino  </input>
                    <input type="radio">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input type="text" class="inputUser" id="endereco"  name="endereco">
                </div>

                <div class="mb-3">
                    <label for="pet_nome" class="form-label">Nome do Pet:</label>
                    <input type="text" class="inputUser" id="pet_nome"  name="pet_nome">
                </div>

                <div class="mb-3">
                    <label for="pet_especie" class="form-label">Espécie do Pet:</label>
                    <input type="text" class="inputUser" id="pet_especie" name="pet_especie">
                </div>

                <div class="mb-3">
                    <label for="pet_raca" class="form-label">Raça do Pet:  </label>
                    <label for="pet_raca" class="form-label">Raça do Pet:</label>
                    <input type="text" class="inputUser" id="pet_raca" name="pet_raca">
                </div>

                <div class="mb-3">
                    <label for="pet_idade" class="form-label">Idade do Pet:  </label>
                    <input type="number" class="inputUser" id="pet_idade" name="pet_idade">
                </div><br>

                <div class="mb-3">
                    <label for="sexopet">Sexo do Pet:  </label>
                    <input type="checkbox">  Macho  </input>
                    <input type="checkbox">  Femea  </input>
                    <input type="checkbox">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="motivo_internacao" class="form-label">Motivo da Internação:  </label>
                    <textarea class="inputUser" id="motivo_internacao" name="motivo_internacao" cols="30" rows="2"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="historico_medico" class="form-label">Histórico Médico:  </label>
                    <input type="file" id="comprovante">
                    <div id="apresentar-imagem"></div>
                </div>

                <div class="mb-3">
                    <label for="medicacoes" class="form-label">Medicações Atuais:  </label>
                    <textarea class="inputUser" id="medicacoes" name="medicacoes" cols="30" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label for="alergias" class="form-label">Alergias:  </label>
                    <input type="checkbox">  Sim  </input>
                    <input type="checkbox">  Não  </input>
                    <textarea type="text" class="inputUser" id="alergias" name="alergias" cols="30" rows="2">Qual Medicação?</textarea>
                </div>

                <div class="mb-3">
                    <label for="contato_emergencia" class="form-label">Contato de Emergência:  </label>
                    <input type="number" class="inputUser" id="contato_emergencia" name="contato_emergencia">
                </div><br>

                <div class="mb-3">
                    <label for="preferencia_data_hora" class="form-label">Preferência de Data e Hora:  </label>
                    <label for="pet_idade" class="form-label">Idade do Pet:</label>
                    <input type="number" class="inputUser" id="pet_idade" name="pet_idade">
                </div>

                <div class="mb-3">
                    <label for="sexopet">Sexo do Pet:  </label>
                    <input type="radio">  Macho  </input>
                    <input type="radio">  Femea  </input>
                    <input type="radio">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="motivo_internacao" class="form-label">Motivo da Internação:</label>
                    <textarea class="inputUser" id="motivo_internacao" name="motivo_internacao" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="historico_medico" class="form-label">Histórico Médico:</label>
                    <textarea class="inputUser" id="historico_medico" name="historico_medico" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="medicacoes" class="form-label">Medicações Atuais:</label>
                    <textarea class="inputUser" id="medicacoes" name="medicacoes" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="alergias" class="form-label">Alergias:</label>
                    <textarea class="inputUser" id="alergias" name="alergias" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="contato_emergencia" class="form-label">Contato de Emergência:</label>
                    <input type="text" class="inputUser" id="contato_emergencia"  name="contato_emergencia">
                    
                </div>

                <div class="mb-3">
                    <label for="preferencia_data_hora" class="form-label">Preferência de Data e Hora:</label>
                    <input type="datetime-local" class="inputUser" id="preferencia_data_hora" name="preferencia_data_hora">
                </div>

                <div class="mb-3">
                    <label for="estado_saude" class="form-label">Estado de Saúde Atual:  </label>
                    <textarea class="inputUser" id="estado_saude" name="estado_saude" cols="30" rows="2"></textarea>
                </div>
                    <label for="mensagem" class="form-label">Mensagem:</label>
                    <textarea class="inputUser" id="mensagem" name="mensagem" cols="30" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="estado_saude" class="form-label">Estado de Saúde Atual:</label>
                    <textarea class="inputUser" id="estado_saude" name="estado_saude" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="alimentacao" class="form-label">Alimentação:</label>
                    <textarea class="inputUser" id="alimentacao" name="alimentacao" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="medicacao_previa" class="form-label">Medicação Prévia:</label>
                    <textarea class="inputUser" id="medicacao_previa" name="medicacao_previa" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="necessidades_especiais" class="form-label">Necessidades Especiais ou Cuidados Específicos:</label>
                    <textarea class="inputUser" id="necessidades_especiais" name="necessidades_especiais" cols="30" rows="3"></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="autorizacao_procedimentos" name="autorizacao_procedimentos">
                    <label class="form-check-label" for="autorizacao_procedimentos">Autorizo a realização de procedimentos adicionais, se necessário.</label>
                </div><br>

                <button type="button" id="generate-pdf">Baixar Formulário</button>
            </form>
        </div>
    </section>
    <script src="./assets/js/pdf.js" defer></script>
    <script>
        document.getElementById('generate-pdf').addEventListener('click', function() {
            const element = document.getElementById('content'); 
            const formData = new FormData(document.getElementById('form'));
            
            html2pdf().from(element).set({ 
                margin: 1,
                filename: 'formulario_preenchido.pdf',
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
                pagebreak: { mode: 'avoid-all' }
            }).save();
        });
    </script>
</main> <br>

<?php include './includes/footer.php'; ?>


            

    

                <div class="mb-3">
                    <label for="alimentacao" class="form-label">Alimentação:  </label>
                    <textarea class="inputUser" id="alimentacao" name="alimentacao" cols="30" rows="2"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="medicacao_previa" class="form-label">Medicação Prévia:  </label>
                    <input type="file" id="comprovante">
                    <div id="apresentar-imagem"></div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem:  </label>
                    <textarea class="inputUser" id="mensagem" name="mensagem" cols="30" rows="2"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="necessidades_especiais" class="form-label">Necessidades Especiais ou Cuidados Específicos:  </label>
                    <input type="checkbox">  Sim  </input>
                    <input type="checkbox">  Não  </input>
                </div><br>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="autorizacao_procedimentos" name="autorizacao_procedimentos">
                    <label class="form-check-label" for="autorizacao_procedimentos">Autorizo a realização de procedimentos adicionais, se necessário.</label>
                </div><br>

                <button type="button" class="button" id="generate-pdf" onclick="converterImagem()">Baixar Formulário</button>
            </form>
        </div>
    </section>
    <script src="./assets/js/pdf.js" defer></script>
    <script>
        document.getElementById('generate-pdf').addEventListener('click', function() {
            const element = document.getElementById('content');
            const formData = new FormData(document.getElementById('form'));

            html2pdf().from(element).set({
                margin: 1,
                filename: 'formulario_preenchido.pdf',
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: 'avoid-all'
                }
            }).save();
        });
    </script>
</main> <br>

<?php include './includes/footer.php'; ?>