<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'fetch_medicos':
                fetchMedicos($UsuarioSenha);
                break;
            case 'fetch_datas':
                fetchDatas($UsuarioSenha);
                break;
            case 'fetch_horas':
                fetchHoras($UsuarioSenha);
                break;
        }
        exit;
    }

    // Recebe os dados do formulário
    $email = $_POST['email'] ?? '';
    $especializacao = $_POST['especializacao'] ?? '';
    $dataAgendamento = $_POST['data_agendamento'] ?? '';
    $horaAgendamento = $_POST['hora_agendamento'] ?? '';
    $servico = $_POST['servico'] ?? '';

    // Validação dos dados e inserção na tabela de agendamentos
    $sqlCliente = "SELECT id_cliente FROM clientes WHERE email = :email";
    $stmtCliente = $UsuarioSenha->prepare($sqlCliente);
    $stmtCliente->execute(['email' => $email]);

    if ($stmtCliente->rowCount() > 0) {
        $rowCliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
        $id_cliente = $rowCliente['id_cliente'];

        $sqlMedicosDisponiveis = "
            SELECT m.id_medico, m.nome
            FROM medicos m
            LEFT JOIN agendamentos a ON m.id_medico = a.id_medico 
            AND a.data_agendamento = :dataAgendamento 
            AND a.hora_agendamento = :horaAgendamento
            WHERE m.especializacao = :especializacao
            AND a.id_medico IS NULL
        ";

        $stmtMedicos = $UsuarioSenha->prepare($sqlMedicosDisponiveis);
        $stmtMedicos->execute([
            'especializacao' => $especializacao,
            'dataAgendamento' => $dataAgendamento,
            'horaAgendamento' => $horaAgendamento
        ]);

        if ($stmtMedicos->rowCount() > 0) {
            $rowMedico = $stmtMedicos->fetch(PDO::FETCH_ASSOC);
            $id_medico = $rowMedico['id_medico'];

            $sqlAgendamento = "
                INSERT INTO agendamentos (id_cliente, data_agendamento, hora_agendamento, id_medico, servico)
                VALUES (:id_cliente, :dataAgendamento, :horaAgendamento, :id_medico, :servico)
            ";
            $stmtAgendamento = $UsuarioSenha->prepare($sqlAgendamento);
            $stmtAgendamento->execute([
                'id_cliente' => $id_cliente,
                'dataAgendamento' => $dataAgendamento,
                'horaAgendamento' => $horaAgendamento,
                'id_medico' => $id_medico,
                'servico' => $servico
            ]);
            echo "<script>alert('Agendamento realizado com sucesso!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "../perfil.php"; }, 2000);</script>';
        } else {
            echo "<script>alert('Nenhum médico disponível para o horário selecionado.');</script>";
        }
    } else {
        echo "<script>alert('Cliente não encontrado.');</script>";
    }
} else {
    echo "<script>alert('Método de requisição inválido.');</script>";
}

function fetchMedicos($db) {
    $especializacao_id = $_POST['especializacao'] ?? '';
    $sql = "SELECT id_medico, nome FROM medicos WHERE especializacao = :especializacao_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['especializacao_id' => $especializacao_id]);
    $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($medicos);
}

function fetchDatas($db) {
    $medico_id = $_POST['medico_id'] ?? '';
    $sql = "SELECT DISTINCT data_agendamento FROM agendamentos WHERE id_medico = :medico_id AND data_agendamento >= CURDATE() ORDER BY data_agendamento";
    $stmt = $db->prepare($sql);
    $stmt->execute(['medico_id' => $medico_id]);
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datas);
}

function fetchHoras($db) {
    $medico_id = $_POST['medico_id'] ?? '';
    $data = $_POST['data'] ?? '';
    $sql = "
        SELECT hora_inicio 
        FROM horarios_medicos 
        WHERE id_medico = :medico_id 
        AND dia_semana = DAYNAME(:data)
    ";
    $stmt = $db->prepare($sql);
    $stmt->execute(['medico_id' => $medico_id, 'data' => $data]);
    $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($horarios);
}

?>
