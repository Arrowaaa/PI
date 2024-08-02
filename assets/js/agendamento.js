document.addEventListener('DOMContentLoaded', function() {
    const especializacaoSelect = document.getElementById('especializacao');
    const selectMedicoGroup = document.getElementById('selectMedicoGroup');
    const selectMedico = document.getElementById('selectMedico');

    especializacaoSelect.addEventListener('change', function() {
        const especializacaoId = especializacaoSelect.value;
        if (especializacaoId) {
            fetch(`fetch_medicos.php?especializacao=${especializacaoId}`)
                .then(response => response.json())
                .then(data => {
                    selectMedico.innerHTML = '<option value="">Selecione o Médico</option>';
                    data.forEach(medico => {
                        selectMedico.innerHTML += `<option value="${medico.id_medico}">${medico.nome}</option>`;
                    });
                    selectMedico.required = true; // Adiciona o atributo required
                    selectMedicoGroup.style.display = 'block';
                })
                .catch(error => console.error('Erro:', error));
        } else {
            selectMedicoGroup.style.display = 'none';
            selectMedico.required = false; // Remove o atributo required
        }
    });
});
