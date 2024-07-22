<?php
require_once './auxi/config.php'; // Inclua o arquivo de configuração

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        echo "Cliente não encontrado.";
    }
} else {
    echo "Nenhum dado enviado.";
}

