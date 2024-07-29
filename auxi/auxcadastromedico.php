<?php
$serve = "62.72.62.1";
$banco = "u687609827_edilson";
$nome = "u687609827_edilson";
$senha = ">2Ana=]b";


$conn = new mysqli($serve, $banco, $nome, $senha);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$nome = $_POST['nome'];
$crm = $_POST['crm'];
$especializacao = $_POST['especializacao'];
$dia_semana = $_POST['dia_semana'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fim = $_POST['hora_fim'];
$disponivel = isset($_POST['disponivel']) ? 1 : 0;


$sql_medico = "INSERT INTO medicos (nome, crm, especializacao) VALUES (?, ?, ?)";
$stmt_medico = $conn->prepare($sql_medico);
$stmt_medico->bind_param("ssi", $nome, $crm, $especializacao);

if ($stmt_medico->execute()) {
    $id_medico = $stmt_medico->insert_id;


    $sql_horario = "INSERT INTO horarios_medicos (id_medico, dia_semana, hora_inicio, hora_fim, disponivel, medico, especializacao) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_horario = $conn->prepare($sql_horario);
    $stmt_horario->bind_param("isssiii", $id_medico, $dia_semana, $hora_inicio, $hora_fim, $disponivel, $id_medico, $especializacao);

    if ($stmt_horario->execute()) {
        echo "Médico e horário cadastrados com sucesso!";
    } else {
        echo "Erro ao cadastrar horário: " . $stmt_horario->error;
    }

    $stmt_horario->close();
} else {
    echo "Erro ao cadastrar médico: " . $stmt_medico->error;
}


$stmt_medico->close();
$conn->close();

