<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Recebe os dados do formulário
    $email = $_POST['email'] ?? '';
    $especializacao = $_POST['especializacao'] ?? '';
    $dataAgendamento = $_POST['DataAgendamento'] ?? '';
    $horaAgendamento = $_POST['HoraAgendamento'] ?? '';

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
            echo "<h3>Médicos Disponíveis:</h3>";
            echo "<ul>";
            while ($rowMedico = $stmtMedicos->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $rowMedico['id_medico'] . " - " . $rowMedico['nome'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Nenhum médico disponível para a especialização, data e hora selecionadas.";
        }
    } else {
        echo '<p class="alert alert-danger">Cliente não encontrado.</p>';
        echo '<script>';
        echo 'setTimeout(function() { window.location.href = "../agendamento.php"; }, 1600);';
        echo '</script>';
    }
} else {

    echo "Erro!.";
}
