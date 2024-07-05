<?php
$servername = "62.72.62.1";
$username = "u687609827_edilson";
$password = ">2Ana=]b";
$dbname = "u687609827_edilson";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$cpf = $_POST['cpf'];
$especializacao = $_POST['especializacao'];
$dataAgendamento = $_POST['DataAgendamento'];
$horaAgendamento = $_POST['HoraAgendamento'];


$slqCliente = "SELECT id_cliente FROM clientes WHERE cpf = '$cpf'";
$resultCliente = $conn->query($slqCliente);

if ($resultCliente->num_rows > 0) {
    $rowCliente = $resultCliente->fetch_assoc();
    $id_cliente = $rowCliente['id_cliente'];

    $slqMedicosDisponiveis = "SELECT id_medico, nome_medico FROM medicos 
                              WHERE especializacao = '$especializacao'
                              AND id_medico NOT IN (
                                  SELECT id_medico FROM agendamentos 
                                  WHERE data_agendamento = '$dataAgendamento' 
                                  AND hora_agendamento = '$horaAgendamento'
                              )";
    
    $resultMedicos = $conn->query($slqMedicosDisponiveis);

    if ($resultMedicos->num_rows > 0) {
       
        echo "<h3>Médicos Disponíveis:</h3>";
        echo "<ul>";
        while ($rowMedico = $resultMedicos->fetch_assoc()) {
            echo "<li>" . $rowMedico['id_medico'] . " - " . $rowMedico['nome_medico'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum médico disponível para a especialização, data e hora selecionadas.";
    }
} else {
    echo "Cliente não encontrado.";
}

$conn->close();

