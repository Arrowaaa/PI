
        // Fonte de dados simulada para médicos, especialidades e CRMs
        const medicosData = {
            clinico: [
                { nome: "Dr. Arrow", crm: "12345" },
                { nome: "Dra. Kara", crm: "54321" }
            ],
            cirurgiao: [
                { nome: "Dr. Ackles", crm: "67890" },
                { nome: "Dra. Anna", crm: "09876" }
            ],
            oftalmologia: [
                { nome: "Dr. Alex", crm: "45678" },
                { nome: "Dra. Sofia", crm: "98765" }
            ],
            cardiologia: [
                { nome: "Dr. Hanry", crm: "23456" },
                { nome: "Dra. Laura", crm: "65432" }
            ],
            ortopedista: [
                { nome: "Dr. Lucas", crm: "13579" },
                { nome: "Dra. Camila", crm: "24680" }
            ],
            neurologista: [
                { nome: "Dr. Gabriel", crm: "11223" },
                { nome: "Dra. Isabela", crm: "33445" }
            ],
            patologia: [
                { nome: "Dr. Thiago", crm: "55667" },
                { nome: "Dra. Marcela", crm: "77889" }
            ],
            medicina: [
                { nome: "Dr. Mateus", crm: "99000" },
                { nome: "Dra. Juliana", crm: "11234" }
            ],
            oncologia: [
                { nome: "Dr. Pedro", crm: "55443" },
                { nome: "Dra. Fernanda", crm: "33221" }
            ],
            dermatologia: [
                { nome: "Dr. Rafael", crm: "11234" },
                { nome: "Dra. Carolina", crm: "44321" }
            ],
            nutricao: [
                { nome: "Dr. André", crm: "98765" },
                { nome: "Dra. Renata", crm: "65432" }
            ]
        };

        // Função para atualizar a lista de médicos e a seleção de médicos com base na especialização selecionada
        function atualizarListaMedicos(especializacao) {
            const medicosListviewElement = document.getElementById("medicosListview");
            const selectMedicoElement = document.getElementById("selectMedico");
            medicosListviewElement.innerHTML = "";
            selectMedicoElement.innerHTML = "";
            selectMedicoElement.innerHTML = "<option value=''>Selecione o Médico</option>"; 
            if (especializacao && medicosData[especializacao]) {
                medicosData[especializacao].forEach(medico => {
                    const listItem = document.createElement("li");
                    listItem.textContent = `${medico.nome} - CRM: ${medico.crm}`;
                    medicosListviewElement.appendChild(listItem);
                    // Criar uma opção para a seleção de médicos
                    const option = document.createElement("option");
                    option.value = medico.crm;
                    option.textContent = `${medico.nome} - CRM: ${medico.crm}`;
                    selectMedicoElement.appendChild(option);
                });

                // Exibir a seleção de médico
                document.getElementById("selectMedicoGroup").style.display = "block";
            } else {
                const listItem = document.createElement("li");
                listItem.textContent = "Por favor, selecione uma especialização.";
                medicosListviewElement.appendChild(listItem);
                // Esconder a seleção de médico se não houver especialização selecionada
                document.getElementById("selectMedicoGroup").style.display = "none";
            }
        }

        // Event listener para atualizar a lista de médicos quando a especialização é alterada
        const selectEspecializacao = document.getElementById("especializacao");
        selectEspecializacao.addEventListener("change", function() {
            const especializacaoSelecionada = this.value;
            atualizarListaMedicos(especializacaoSelecionada);
        });
 