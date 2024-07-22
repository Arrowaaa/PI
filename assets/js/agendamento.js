document.addEventListener("DOMContentLoaded", function() {
    function atualizarListaMedicos(especializacao) {
        const selectMedicoElement = document.getElementById("selectMedico");
        selectMedicoElement.innerHTML = "<option value=''>Selecione o Médico</option>";
        
        fetch(`/auxi/agendar_consulta.php?especializacao=${especializacao}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(medico => {
                        const option = document.createElement("option");
                        option.value = medico.id_medico;
                        option.textContent = `${medico.nome_medico} - CRM: ${medico.crm}`;
                        selectMedicoElement.appendChild(option);
                    });
                    document.getElementById("selectMedicoGroup").style.display = "block";
                } else {
                    document.getElementById("selectMedicoGroup").style.display = "none";
                }
            })
            .catch(error => console.error('Erro ao buscar médicos:', error));
    }

    document.getElementById("especializacao").addEventListener("change", function() {
        const especializacaoSelecionada = this.value;
        atualizarListaMedicos(especializacaoSelecionada);
    });
});
