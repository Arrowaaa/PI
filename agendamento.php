<?php
$serve = "62.72.62.1";
$banco = "u687609827_edilson";
$nome = "u687609827_edilson";
$senha = ">2Ana=]b";

try {
    // Criação da conexão PDO
    $conn = new PDO("mysql:host=$serve;dbname=$banco", $nome, $senha);
    // Configuração do modo de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['action']) && $_POST['action'] === 'fetch_medicos') {
        $especializacaoId = $_POST['especializacao'];

        $stmt = $conn->prepare("SELECT id_medico, nome FROM medicos WHERE especializacao = :especializacao");
        $stmt->execute(['especializacao' => $especializacaoId]);
        $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($medicos);
        exit;
    }

    // Consulta para carregar especializações
    $stmtEspecializacoes = $conn->query("SELECT * FROM especializacao");
    $especializacoes = $stmtEspecializacoes->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para carregar médicos
    $stmtMedicos = $conn->query("SELECT * FROM medicos");
    $medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para carregar serviços
    $stmtServicos = $conn->query("SELECT * FROM servico");
    $servicos = $stmtServicos->fetchAll(PDO::FETCH_ASSOC);
    
     // Obter id_cliente da URL e buscar o email correspondente
     $email = '';
     if (isset($_GET['id_cliente'])) {
         $id_cliente = $_GET['id_cliente'];
         $stmtEmail = $conn->prepare("SELECT email FROM clientes WHERE id_cliente = :id_cliente");
         $stmtEmail->execute(['id_cliente' => $id_cliente]);
         $result = $stmtEmail->fetch(PDO::FETCH_ASSOC);
         if ($result) {
             $email = $result['email'];
         }
     }
} catch (PDOException $e) {
    // Mensagem de erro
    die("Erro de conexão: " . $e->getMessage());
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
        <a href="<?= isset($id_alterar) ? 'perfil.php?id_cliente=' . $id_alterar : 'perfil.php?id_cliente=' . $id_cliente ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <h2>Agendamento</h2><br>
        <form id="agendamentoForm" action="/auxi/agendar_consulta.php" method="post">
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="input">
                <label for="servico">Selecione o Serviço:</label>   
                <select id="servico" name="servico" required>
                    <option value=""></option>
                    <?php foreach ($servicos as $servico) : ?>
                        <option value="<?= $servico['id_servico'] ?>"><?= $servico['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group">
                <label for="especializacao">Especialização:</label>   
                <select id="especializacao" name="especializacao" required>
                    <?php foreach ($especializacoes as $especializacao) : ?>
                        <option value="<?= $especializacao['id_especializacao'] ?>"><?= $especializacao['especializacao'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <div class="input-group" id="selectMedicoGroup" style="display: none;">
                <label for="selectMedico">Escolha o Médico:</label>
                <select id="selectMedico" name="selectMedico">
                    <option value="">Selecione o Médico</option>
                </select>
            </div><br>

            <div>
                <label for="DataAgendamento">Data do Agendamento:</label>
                <input type="date" id="DataAgendamento" name="DataAgendamento" required>
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
    </script>
</body>

</html>
