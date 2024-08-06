<?php
session_start();
include './auxi/config.php';

try {
    if (isset($_POST['action']) && $_POST['action'] === 'fetch_horas') {
        $medicoId = filter_var($_POST['medico_id'], FILTER_SANITIZE_NUMBER_INT);
        $data = filter_var($_POST['data'], FILTER_SANITIZE_STRING);

        // Mapeamento de dias da semana
        $diasSemana = [
            'Monday'    => 'Segunda',
            'Tuesday'   => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday'  => 'Quinta',
            'Friday'    => 'Sexta',
            'Saturday'  => 'Sábado',
            'Sunday'    => 'Domingo'
        ];

        // Determinar o dia da semana em português
        $diaSemana = date('l', strtotime($data));
        $diaSemana = $diasSemana[$diaSemana] ?? 'Segunda'; // Default to 'Segunda' if not found

        // Log para depuração
        error_log("Médico ID: $medicoId");
        error_log("Data: $data");
        error_log("Dia da Semana: $diaSemana");

        // Obter horários disponíveis do médico
        $stmtHorarios = $UsuarioSenha->prepare("
            SELECT id_horario, hora_inicio, hora_fim
            FROM horarios_medicos
            WHERE id_medico = ?
            AND dia_semana = ?
            AND disponivel = 1
        ");
        $stmtHorarios->execute([$medicoId, $diaSemana]);
        $horarios = $stmtHorarios->fetchAll(PDO::FETCH_ASSOC);

        // Log para depuração
        error_log("Dados das horas: " . print_r($horarios, true));

        // Obter agendamentos para a data
        $stmtAgendamentos = $UsuarioSenha->prepare("
            SELECT hora_agendamento
            FROM agendamentos
            WHERE id_medico = ?
            AND data_agendamento = ?
        ");
        $stmtAgendamentos->execute([$medicoId, $data]);
        $agendamentos = $stmtAgendamentos->fetchAll(PDO::FETCH_ASSOC);

        // Log para depuração
        error_log("Dados dos agendamentos: " . print_r($agendamentos, true));

        // Filtrar horários disponíveis excluindo os já agendados
        $horariosDisponiveis = array_filter($horarios, function($horario) use ($agendamentos) {
            foreach ($agendamentos as $agendamento) {
                // Converte horário para o mesmo formato
                $horaAgendada = new DateTime($agendamento['hora_agendamento']);
                $horaInicio = new DateTime($horario['hora_inicio']);
                $horaFim = new DateTime($horario['hora_fim']);

                if ($horaInicio <= $horaAgendada && $horaFim >= $horaAgendada) {
                    return false; // Horário já está agendado
                }
            }
            return true; // Horário disponível
        });

        header('Content-Type: application/json');
        echo json_encode($horariosDisponiveis);
        exit;
    }

    // Consultas para carregar especializações e serviços
    $stmtEspecializacoes = $UsuarioSenha->query("SELECT * FROM especializacao");
    $especializacoes = $stmtEspecializacoes->fetchAll(PDO::FETCH_ASSOC);

    $stmtServicos = $UsuarioSenha->query("SELECT * FROM servico");
    $servicos = $stmtServicos->fetchAll(PDO::FETCH_ASSOC);

    // Obter id_cliente da sessão e buscar o email e os pets correspondentes
    $email = '';
    $pets = [];
    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = filter_var($_SESSION['id_cliente'], FILTER_SANITIZE_NUMBER_INT);

        // Buscar email do cliente
        $stmtEmail = $UsuarioSenha->prepare("SELECT email FROM clientes WHERE id_cliente = ?");
        $stmtEmail->execute([$id_cliente]);
        $result = $stmtEmail->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $email = htmlspecialchars($result['email']);
        }

        // Buscar pets do cliente
        $stmtPets = $UsuarioSenha->prepare("SELECT id_pet, nomep FROM pets WHERE id_cliente = ?");
        $stmtPets->execute([$id_cliente]);
        $pets = $stmtPets->fetchAll(PDO::FETCH_ASSOC);
    } else {
        header('Location: login.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erro de conexão: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
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
        <a href="perfil.php" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <h2>Agendamento</h2><br>
        <form id="agendamentoForm" action="./auxi/agendar_consulta.php" method="post">
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="input">
                <label for="servico">Selecione o Serviço:  </label>
                <select id="servico" name="servico" required>
                    <option value=""></option>
                    <?php foreach ($servicos as $servico) : ?>
                        <option value="<?= htmlspecialchars($servico['id_servico']) ?>"><?= htmlspecialchars($servico['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group">
                <label for="especializacao">Especialização:  </label>
                <select id="especializacao" name="especializacao" required>
                    <option value=""></option>
                    <?php foreach ($especializacoes as $especializacao) : ?>
                        <option value="<?= htmlspecialchars($especializacao['id_especializacao']) ?>"><?= htmlspecialchars($especializacao['especializacao']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group" id="selectMedicoGroup" style="display: none;">
                <label for="selectMedico">Escolha o Médico:  </label>
                <select id="selectMedico" name="selectMedico">
                    <option value="">Selecione o Médico</option>
                </select>
            </div><br>

            <div class="input-group" id="selectDataGroup" style="display: none;">
                <label for="selectData">Escolha a Data:   </label>
                <select id="selectData" name="data_agendamento">
                    <option value="">Selecione a Data</option>
                </select>
            </div><br>

            <div class="input-group" id="selectHoraGroup" style="display: none;">
                <label for="selectHora">Escolha a Hora:   </label>
                <select id="selectHora" name="hora_agendamento">
                    <option value="">Selecione a Hora</option>
                </select>
            </div><br>

            <div class="input-group" id="selectpet">
                <label for="selectpet">Escolha o Pet:  </label>
                <select id="selectpet" name="selectpet" required>
                    <option value="">Selecione o Pet </option>
                    <?php foreach ($pets as $pet) : ?>
                        <option value="<?= htmlspecialchars($pet['id_pet']) ?>"><?= htmlspecialchars($pet['nomep']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br><br>

            <div class="button-group">
                <center>
                    <button type="submit" class="button-link">Agendar Consulta<span></span></button>
                </center>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('especializacao').addEventListener('change', function() {
            let especializacaoId = this.value;
            fetchMedicos(especializacaoId);
        });

        document.getElementById('selectMedico').addEventListener('change', function() {
            let medicoId = this.value;
            fetchDatas(medicoId);
        });

        document.getElementById('selectData').addEventListener('change', function() {
            let medicoId = document.getElementById('selectMedico').value;
            let data = this.value;
            fetchHoras(medicoId, data);
        });

        function fetchMedicos(especializacaoId) {
            fetch('./auxi/agendar_consulta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'action': 'fetch_medicos',
                        'especializacao': especializacaoId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let medicoSelect = document.getElementById('selectMedico');
                    medicoSelect.innerHTML = '<option value="">Selecione o Médico</option>';
                    data.forEach(medico => {
                        let option = document.createElement('option');
                        option.value = medico.id_medico;
                        option.textContent = medico.nome;
                        medicoSelect.appendChild(option);
                    });
                    document.getElementById('selectMedicoGroup').style.display = 'block';
                });
        }

        function fetchDatas(medicoId) {
            fetch('./auxi/agendar_consulta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'action': 'fetch_datas',
                        'medico_id': medicoId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let dataSelect = document.getElementById('selectData');
                    dataSelect.innerHTML = '<option value="">Selecione a Data</option>';
                    data.forEach(dataItem => {
                        let option = document.createElement('option');
                        option.value = dataItem.data_agendamento;
                        option.textContent = dataItem.data_agendamento;
                        dataSelect.appendChild(option);
                    });
                    document.getElementById('selectDataGroup').style.display = 'block';
                });
        }

        function fetchHoras(medicoId, data) {
            fetch('./auxi/agendar_consulta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'action': 'fetch_horas',
                        'medico_id': medicoId,
                        'data': data
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dados das horas:', data); // Verifique o conteúdo dos dados recebidos
                    let horaSelect = document.getElementById('selectHora');
                    horaSelect.innerHTML = '<option value="">Selecione a Hora</option>';
                    if (Array.isArray(data) && data.length) {
                        data.forEach(hora => {
                            let option = document.createElement('option');
                            option.value = hora.hora_inicio;
                            option.textContent = hora.hora_inicio;
                            horaSelect.appendChild(option);
                        });
                        document.getElementById('selectHoraGroup').style.display = 'block';
                    } else {
                        // Caso não haja horários disponíveis
                        horaSelect.innerHTML = '<option value="">Nenhum horário disponível</option>';
                        document.getElementById('selectHoraGroup').style.display = 'block';
                    }
                })
                .catch(error => console.error('Erro na requisição:', error));
        }
    </script>
</body>

</html>