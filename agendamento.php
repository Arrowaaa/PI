<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/2.png" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/cachorro.png" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
    <a href="<?= $id_cliente ? 'perfil.php?id_cliente=' . $id_cliente : 'javascript:history.back()'; ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a><br>
        <h2>Agendamento de Consultas</h2><br>
        <form action="agendar_consulta.php" method="post">
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
            </div>

            <label for="especializacao">Especialização:</label>
            <select id="especializacao" name="especializacao" required>
                <!-- As opções devem ser preenchidas pelo PHP ou JavaScript -->
            </select><br>

            <div class="input-group" id="selectMedicoGroup" style="display: none;">
                <label for="selectMedico">Escolha o Médico:</label>
                <select id="selectMedico" name="selectMedico" required>
                    <option value="">Selecione o Médico</option>
                </select>
            </div>
            <br>
            <div id="agendamentoForm">
                <div class="dados">
                    <label for="DataAgendamento">Data do Agendamento:</label>
                    <input type="date" id="DataAgendamento" name="DataAgendamento" required>
                </div>
                <div class="dados">
                    <label for="HoraAgendamento">Hora do Agendamento:</label>
                    <input type="time" id="HoraAgendamento" name="HoraAgendamento" required>
                </div>

                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Agendar Consulta<span></span></button>
                    </center>
                </div>

            </div>
        </form>
    </div>
    <script src="assets/js/agendamento.js"></script>
</body>

</html>
