<?php include './includes/header.php'; ?>
<link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
<main>
    <section id="box">
        <div id="content">
            <form action="#" id="form" enctype="multipart/form-data">
                <h2>Preencha Seus Dados Da Internação</h2>
                <br>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:  </label>
                    <input type="text" class="inputUser" id="nome" name="nome" maxlength="30">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF:  </label>
                    <input type="text" class="inputUser" id="cpf" name="cpf" maxlength="14">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone:  </label>
                    <input type="number" class="inputUser" id="telefone" name="numerotelefonico" maxlength="14">
                    <script src="assets/js/mascaras.js"></script>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:  </label>
                    <input type="email" class="inputUser" id="email" name="email"  maxlength="30">
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento:  </label>
                    <input type="date" class="inputUser" id="data_nascimento" name="data_nascimento">
                </div><br>

                <div class="mb-3">
                    <label for="sexo">Sexo do Tutor:  </label>
                    <input type="radio" name="sexo">  Masculino  </input>
                    <input type="radio" name="sexo">  Feminino  </input>
                    <input type="radio" name="sexo">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço:  </label>
                    <input type="text" class="inputUser" id="endereco" name="endereco" maxlength="30">
                </div>

                <div class="mb-3">
                    <label for="pet_nome" class="form-label">Nome do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_nome" name="pet_nome"  maxlength="14">
                </div>

                <div class="mb-3">
                    <label for="pet_especie" class="form-label">Espécie do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_especie" name="pet_especie" maxlength="20">
                </div>

                <div class="mb-3">
                    <label for="pet_raca" class="form-label">Raça do Pet:  </label>
                    <input type="text" class="inputUser" id="pet_raca" name="pet_raca" maxlength="20">
                </div>

                <div class="mb-3">
                    <label for="pet_idade" class="form-label">Idade do Pet:  </label>
                    <input type="number" class="inputUser" id="pet_idade" name="pet_idade">
                </div><br>

                <div class="mb-3">
                    <label for="sexopet">Sexo do Pet:  </label>
                    <input type="radio" name="sexopet">  Macho  </input>
                    <input type="radio" name="sexopet">  Fêmea  </input>
                    <input type="radio" name="sexopet">  Outros  </input>
                </div>

                <div class="mb-3">
                    <label for="motivo_internacao" class="form-label">Motivo da Internação:  </label>
                    <textarea class="inputUser" id="motivo_internacao" name="motivo_internacao" cols="30" rows="1"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="historico_medico" class="form-label">Histórico Médico:  </label>
                    <input type="file" id="historico_medico" accept="image/*">
                    <div id="apresentar-imagem-historico"></div>
                </div>

                <div class="mb-3">
                    <label for="medicacoes" class="form-label">Medicações Atuais:  </label>
                    <textarea class="inputUser" id="medicacoes" name="medicacoes" cols="30" rows="1"></textarea>
                </div>

                <div class="mb-3">
                    <label for="alergias" class="form-label">Alergias:  </label>
                    <input type="radio" name="alergias">  Sim  </input>
                    <input type="radio" name="alergias">  Não  </input>
                    <textarea type="text" class="inputUser" id="alergias" name="alergias" cols="30" rows="1">Qual Medicação?</textarea>
                </div>

                <div class="mb-3">
                    <label for="contato_emergencia" class="form-label">Contato de Emergência:  </label>
                    <input type="number" class="inputUser" id="contato_emergencia" name="contato_emergencia">
                    <script src="assets/js/mascaras.js"></script>
                </div><br>

                <div class="mb-3">
                    <label for="preferencia_data_hora" class="form-label">Preferência de Data e Hora:  </label>
                    <input type="datetime-local" class="inputUser" id="preferencia_data_hora" name="preferencia_data_hora">
                </div>

                <div class="mb-3">
                    <label for="estado_saude" class="form-label">Estado de Saúde Atual:  </label>
                    <textarea class="inputUser" id="estado_saude" name="estado_saude" cols="30" rows="1"></textarea>
                </div>

                <div class="mb-3">
                    <label for="alimentacao" class="form-label">Alimentação:  </label>
                    <textarea class="inputUser" id="alimentacao" name="alimentacao" cols="30" rows="1"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="medicacao_previa" class="form-label">Medicação Prévia:  </label>
                    <input type="file" id="medicacao_previa" accept="image/*">
                    <div id="apresentar-imagem-previa"></div>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem:  </label>
                    <textarea class="inputUser" id="mensagem" name="mensagem" cols="30" rows="1"></textarea>
                </div><br>

                <div class="mb-3">
                    <label for="necessidades_especiais" class="form-label">Necessidades Especiais ou Cuidados Específicos:  </label>
                    <input type="radio" name="necessidades_especiais">  Sim  </input>
                    <input type="radio" name="necessidades_especiais">  Não  </input>
                </div><br>

                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" id="autorizacao_procedimentos" name="autorizacao_procedimentos">
                    <label class="form-check-label" for="autorizacao_procedimentos">Autorizo a realização de procedimentos adicionais, se necessário.</label>
                </div><br>
                <button type="button" class="button" id="generate-pdf">Baixar Formulário</button>

            </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function displayImage(inputId, previewId) {
                const input = document.querySelector(inputId);
                const preview = document.querySelector(previewId)
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.style.maxWidth = '10%';
                            preview.innerHTML = '';
                            preview.appendChild(imgElement);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            displayImage('#historico_medico', '#apresentar-imagem-historico');
            displayImage('#medicacao_previa', '#apresentar-imagem-previa');
            document.querySelector('#generate-pdf').addEventListener('click', () => {
                const content = document.querySelector("#content");
                const generate = document.querySelector("#generate-pdf");
                generate.classList.add("no-print");
                const options = {
                    margin: [10, 10, 10, 10],
                    filename: "formulario.pdf",
                    html2canvas: {
                        scale: 2,
                        scrollX: 0,
                        scrollY: 0
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "a4",
                        orientation: "portrait"
                    }
                };
                html2pdf().set(options).from(content).toPdf().get('pdf').then(function(pdf) {
                    const images = [{
                            id: '#apresentar-imagem-historico',
                            x: 10,
                            y: 140
                        },
                        {
                            id: '#apresentar-imagem-previa',
                            x: 10,
                            y: 200
                        }
                    ];
                    images.forEach(imgInfo => {
                        const imgElement = document.querySelector(imgInfo.id + ' img');
                        if (imgElement) {
                            const imgData = imgElement.src;
                            const imgWidth = 190;
                            const imgHeight = imgElement.naturalHeight * imgWidth / imgElement.naturalWidth;
                            const maxPageHeight = 297 - 20; 
                            if (imgHeight > maxPageHeight) {
                                const scale = maxPageHeight / imgHeight;
                                imgWidth *= scale;
                                imgHeight = maxPageHeight;
                            }

                            pdf.addImage(imgData, 'JPEG', imgInfo.x, imgInfo.y, imgWidth, imgHeight);
                            imgInfo.y += imgHeight + 10;
                        }
                    });
                    pdf.save();
                }).catch(err => console.error(err)).finally(() => {
                    generate.classList.remove("no-print");
                });
            }, 300);
        });
    </script>
</main>
<br>
<?php include './includes/footer.php'; ?>

<style>
    .no-print {
        display: none !important;
    }
    @media print {
        body,
        #content {
            margin: 0;
            box-shadow: none;
        }
    }
</style>