<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $email = $_POST['email'] ?? '';
    $especializacao = $_POST['especializacao'] ?? '';
    $dataAgendamento = $_POST['DataAgendamento'] ?? '';
    $horaAgendamento = $_POST['HoraAgendamento'] ?? '';
    $servico = $_POST['servico'] ?? '';

    // Valida a data e hora
    $validHorarios = ['09:00', '09:45', '10:30', '11:15', '12:00', '12:45', '13:30', '14:15', '15:00', '15:45', '16:30', '17:15'];
    if (!in_array($horaAgendamento, $validHorarios)) {
        die("Horário inválido. Por favor, selecione um horário válido.");
    }

    // Prepara e executa a consulta para encontrar o id_cliente
    $sqlCliente = "SELECT id_cliente FROM clientes WHERE email = :email";
    $stmtCliente = $UsuarioSenha->prepare($sqlCliente);
    $stmtCliente->execute(['email' => $email]);

    if ($stmtCliente->rowCount() > 0) {
        $rowCliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
        $id_cliente = $rowCliente['id_cliente'];

        // Prepara e executa a consulta para encontrar médicos disponíveis
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

        

            // Insere o agendamento no banco de dados
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
            echo '<p class="alert alert-success">Agendamento realizado com sucesso!</p>';
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "../perfil.php"; }, 1800);';
            echo '</script>';
        } else {
            echo "Nenhum médico disponível para o horário selecionado.";
        }
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "Método de requisição inválido.";
}
