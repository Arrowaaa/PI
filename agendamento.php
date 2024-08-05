<?php
session_start();
include './auxi/config.php'; 

try {
    // Verificar se a ação é para buscar médicos
    if (isset($_POST['action']) && $_POST['action'] === 'fetch_medicos') {
        $especializacaoId = filter_var($_POST['especializacao'], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $UsuarioSenha->prepare("SELECT id_medico, nome FROM medicos WHERE especializacao = :especializacao");
        $stmt->execute(['especializacao' => $especializacaoId]);
        $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($medicos);
        exit;
    }

    // Consulta para carregar especializações
    $stmtEspecializacoes = $UsuarioSenha->query("SELECT * FROM especializacao");
    $especializacoes = $stmtEspecializacoes->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para carregar serviços
    $stmtServicos = $UsuarioSenha->query("SELECT * FROM servico");
    $servicos = $stmtServicos->fetchAll(PDO::FETCH_ASSOC);

    // Obter id_cliente da sessão e buscar o email e os pets correspondentes
    $email = '';
    $pets = [];
    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = filter_var($_SESSION['id_cliente'], FILTER_SANITIZE_NUMBER_INT);
        
        // Buscar email do cliente
        $stmtEmail = $UsuarioSenha->prepare("SELECT email FROM clientes WHERE id_cliente = :id_cliente");
        $stmtEmail->execute(['id_cliente' => $id_cliente]);
        $result = $stmtEmail->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $email = htmlspecialchars($result['email']);
        }

        // Buscar pets do cliente
        $stmtPets = $UsuarioSenha->prepare("SELECT id_pet, nomep FROM pets WHERE id_cliente = :id_cliente");
        $stmtPets->execute(['id_cliente' => $id_cliente]);
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
                <label for="servico">Selecione o Serviço:</label>
                <select id="servico" name="servico" required>
                    <option value=""></option>
                    <?php foreach ($servicos as $servico) : ?>
                        <option value="<?= htmlspecialchars($servico['id_servico']) ?>"><?= htmlspecialchars($servico['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group">
                <label for="especializacao">Especialização:</label>
                <select id="especializacao" name="especializacao" required>
                    <option value=""></option>
                    <?php foreach ($especializacoes as $especializacao) : ?>
                        <option value="<?= htmlspecialchars($especializacao['id_especializacao']) ?>"><?= htmlspecialchars($especializacao['especializacao']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group" id="selectMedicoGroup" style="display: none;">
                <label for="selectMedico">Escolha o Médico:</label>
                <select id="selectMedico" name="selectMedico">
                    <option value="">Selecione o Médico</option>
                </select>
            </div><br>
            <div class="input-group" id="selectpet">
                <label for="selectpet">Escolha o Pet:</label>
                <select id="selectpet" name="selectpet" required>
                    <option value="">Selecione o Pet</option>
                    <?php foreach ($pets as $pet) : ?>
                        <option value="<?= htmlspecialchars($pet['id_pet']) ?>"><?= htmlspecialchars($pet['nomep']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div>
                <label for="DataAgendamento">Data do Agendamento:</label>
                <input type="date" id="DataAgendamento" name="DataAgendamento" min="2024-08-03" max="9999-12-31" required>
            </div><br>
            <div>
                <label for="HoraAgendamento">Hora do Agendamento:</label>
                <select id="HoraAgendamento" name="HoraAgendamento" required>
                    <option value="09:00">09:00</option>
                    <option value="09:45">09:45</option>
                    <option value="10:30">10:30</option>
                    <option value="11:15">11:15</option>
                    <option value="12:00">12:00</option>
                    <option value="12:45">12:45</option>
                    <option value="13:30">13:30</option>
                    <option value="14:15">14:15</option>
                    <option value="15:00">15:00</option>
                    <option value="15:45">15:45</option>
                    <option value="16:30">16:30</option>
                    <option value="17:15">17:15</option>
                    <option value="18:00">18:00</option>
                </select>
            </div><br>

            <div class="button-group">
                <center>
                    <button type="submit" class="button-link">Agendar Consulta<span></span></button>
                </center>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const especializacaoSelect = document.getElementById('especializacao');
            const selectMedicoGroup = document.getElementById('selectMedicoGroup');
            const selectMedico = document.getElementById('selectMedico');

            especializacaoSelect.addEventListener('change', function() {
                const especializacaoId = especializacaoSelect.value;
                if (especializacaoId) {
                    fetch('agendamento.php', {
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
                        selectMedico.innerHTML = '<option value="">Selecione o Médico</option>';
                        data.forEach(medico => {
                            selectMedico.innerHTML += `<option value="${medico.id_medico}">${medico.nome}</option>`;
                        });
                        selectMedico.required = true;
                        selectMedicoGroup.style.display = 'block';
                    })
                    .catch(error => console.error('Erro:', error));
                } else {
                    selectMedicoGroup.style.display = 'none';
                    selectMedico.required = false;
                }
            });
        });
    </script>
</body>
</html>
