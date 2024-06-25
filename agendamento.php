<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="imagens">
        <img src="assets/img/cachorros/2.png" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/cachorro.png" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <h2>Agendamento de Consultas</h2>

        <div class="input-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>
            <script src="assets/js/mascaras.js"></script>
        </div>
        <div class="dado">
            <label for="especializacao">Especialização:</label>
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
        </div> <br>
        
        <!-- Seleção de médico -->
        <div class="input-group" id="selectMedicoGroup" style="display: none;">
            <label for="selectMedico">Escolha o Médico:</label>
            <select id="selectMedico" name="selectMedico" required></select>
        </div>

        <form id="agendamentoForm" action="#" method="POST">
            <div class="dados">
                <label for="DataAgendamento">Data do Agendamento:</label>
                <input type="date" id="DataAgendamento" name="DataAgendamento" required>
            </div>
            <div class="dados">
                <label for="HoraAgendamento">Hora do Agendamento:</label>
                <input type="time" id="HoraAgendamento" name="HoraAgendamento" required>
            </div>
            <!-- Lista de médicos -->
            <div class="input-group" id="listaMedicos">
                <label for="listaMedicos">Médicos Disponíveis:</label>
                <ul id="medicosListview"></ul>
            </div>
            <!-- Botões -->
            <button type="submit" class="button">Agendar Consulta</button>
            
            <p><a href="perfil.php" class="button">Seu Perfil</a></p>
        </form>
    </div>
    <script src="assets/js/agendamento.js"></script>
</body>
</html>
