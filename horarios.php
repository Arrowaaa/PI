<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários de Trabalho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container">
        <h2>Horários de Trabalho</h2>
        <form id="horariosForm" action="#" method="POST">
            <div class="input-group">
                <label for="medico">Médico:</label>
                <input type="text" id="medico" name="dr" required>
                <script src="assets/js/mascaras.js"></script>
            </div>
            <div class="input-group">
                <label for="crm">CRM:</label>
                <input type="text" id="crm" name="crm" required>
                <script src="assets/js/mascaras.js"></script>
            </div>
            <div class="input-group">
                <label for="especialização">Especialização:</label>
                <select id="especializacao" name="especializacao" required>
                    <option></option>
                    <option value="clinico">Veterinário Clinico</option>
                    <option value="cirurgiao">Cirurgião</option>
                    <option value="oftalmologia">Oftalmologia</option>
                    <option value="cardiologia">Cardiologia</option>
                    <option value="ortopedista">Ortopedia</option>
                    <option value="neurologista">Neurologia</option>
                    <option value="patologia">Patologia</option>
                    <option value="medicina">Medicina Intensiva Veterinária</option>
                    <option value="oncologia">Oncologia</option>
                    <option value="dermatologia">Dermatologia</option>
                    <option value="nutricao">Nutricionista</option>
                </select>
            </div>
            <div class="input-group">
                <label for="diasemana">Dia da Semana:</label>
                <select type="text" id="diasemana" name="diasemana" required>
                    <option></option>
                    <option value="segunda">Segunda-Feira</option>
                    <option value="terca">Terça-Feira</option>
                    <option value="quarta">Quarta-Feira</option>
                    <option value="quita">Quinta-Feira</option>
                    <option value="sexta">Sexta-Feira</option>
                    <option value="sabado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
            </div>
            <div class="input-group">
                <label for="horarioinicio">Horário de Início:</label>
                <input type="time" id="horarioinicio" name="horarioinicio" required>
            </div>
            <div class="input-group">
                <label for="horariofim">Horário de Fim:</label>
                <input type="time" id="horariofim" name="horariofim" required>
            </div>
            <button type="submit" class="button">Salvar Horário</button>
        </form>
    </div>
    <script src="assets/js/mascaras.js"></script>
</body>

</html>
