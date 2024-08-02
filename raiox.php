<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <title>Formulário de Raio-X</title>
    <style>
        /* CSS para evitar quebras de página indesejadas */
        body {
            font-family: Arial, sans-serif;
        }

        #content {
            width: 210mm;
            /* Largura do A4 */
            min-height: 297mm;
            /* Altura mínima do A4 */
            padding: 10mm;
            /* Padding para evitar quebras de conteúdo */
            margin: 0 auto;
        }

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
</head>

<body>
    <?php include './includes/header.php'; ?>
    <main>
        <section id="box">
            <div id="content">
                <form action="#" id="form" enctype="multipart/form-data">
                    <h2>Preencha Seus Dados Do Raio-X</h2>
                    <br>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:  </label>
                        <input type="text" class="inputUser" id="nome" name="nome" minlength="3" maxlength="30">
                        <script src="assets/js/mascaras.js"></script>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:  </label>
                        <input type="text" class="inputUser" id="cpf" name="cpf" minlength="14" maxlength="14">
                        <script src="assets/js/mascaras.js"></script>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="number" class="inputUser" id="telefone" name="telefone">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:  </label>
                        <input type="email" class="inputUser" id="email" name="email" minlength="15" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="date">Data de Nascimento:  </label>
                        <input type="date" class="inputUser">
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="sexo">Sexo do Tutor:  </label>
                        <input type="radio" name="sexo">  Masculino  </input>
                        <input type="radio" name="sexo">  Feminino  </input>
                        <input type="radio" name="sexo">  Outros  </input>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço:  </label>
                        <input type="text" class="inputUser" id="endereco" name="endereco" minlength="5" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="pet_nome" class="form-label">Nome do Pet:  </label>
                        <input type="text" class="inputUser" id="pet_nome" name="pet_nome" minlength="2" maxlength="14">
                    </div>
                    <div class="mb-3">
                        <label for="pet_especie" class="form-label">Espécie do Pet:  </label>
                        <input type="text" class="inputUser" id="pet_especie" name="pet_especie" minlength="3" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="pet_raca" class="form-label">Raça do Pet:  </label>
                        <input type="text" class="inputUser" id="pet_raca" name="pet_raca" minlength="3" maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="pet_idade">Idade do Pet:  </label>
                        <input type="number" class="inputUser" id="pet_idade" name="pet_idade">
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="sexopet">Sexo do Pet:  </label>
                        <input type="radio" name="sexopet">  Macho  </input>
                        <input type="radio" name="sexopet">  Femea  </input>
                        <input type="radio" name="sexopet">  Outros  </input>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="preferencia_data_hora" class="form-label">Preferência de Periodo:  </label>
                        <input type="radio" name="preferencia_data_hora">  Manhã  </input>
                        <input type="radio" name="preferencia_data_hora">  Tarde  </input>
                        <input type="radio" name="preferencia_data_hora">  Noite  </input>
                    </div>
                    <div class="mb-3">
                        <label for="sintomas" class="form-label">Sintomas ou Razão do Exame:  </label>
                        <textarea class="inputUser" id="sintomas" name="sintomas" cols="30" rows="1"></textarea>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="historico_medico" class="form-label">Histórico Médico:  </label>
                        <input type="file" id="comprovante" accept="image/*">
                        <div id="apresentar-imagem"></div>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Deixe sua mensagem:  </label>
                        <textarea class="inputUser" id="mensagem" name="mensagem" cols="30" rows="1"></textarea>
                    </div>
                    <br>
                    <button type="button" class="button" id="generate-pdf">Baixar Formulário</button>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                </form>
            </div>
        </section>

    </main>
    <br>
    <?php include './includes/footer.php'; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnGenerate = document.querySelector("#generate-pdf");
            btnGenerate.addEventListener("click", () => {
                const content = document.querySelector("#content");
                const generate = document.querySelector("#generate-pdf"); // Substitua pelo seletor do seu elemento

                // Adiciona a classe no-print ao elemento que você deseja excluir do PDF
                generate.classList.add("no-print");
                const options = {
                    margin: [10, 10, 10, 10],
                    filename: "formulario.pdf",
                    html2canvas: {
                        scale: 2,
                        scrollX: 0,
                        scrollY: 0,
                        width: content.scrollWidth,
                        height: content.scrollHeight
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "a4",
                        orientation: "portrait"
                    }
                };

                setTimeout(() => {
                    html2pdf().set(options).from(content).toPdf().get('pdf').then(function(pdf) {
                        // Adicionar imagem ao PDF
                        const imgElement = document.querySelector("#apresentar-imagem img");
                        if (imgElement) {
                            const imgData = imgElement.src;
                            const imgWidth = 210; // Largura da página A4
                            const imgHeight = imgElement.naturalHeight * imgWidth / imgElement.naturalWidth;
                            pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
                        }
                        pdf.save();
                    }).catch(err => console.error(err)).finally(() => {
                        // Remove a classe no-print do elemento após gerar o PDF
                        generate.classList.remove("no-print");
                    });
                }, 300);
            });

            // Adiciona a imagem ao div quando o arquivo é selecionado
            document.querySelector('#comprovante').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.maxWidth = '10%';
                        document.querySelector('#apresentar-imagem').innerHTML = '';
                        document.querySelector('#apresentar-imagem').appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>