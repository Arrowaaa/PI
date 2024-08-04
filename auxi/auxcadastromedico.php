<?php
include 'config.php';

try {
    $nome = $_POST['nome'];
    $crm = $_POST['crm'];
    $especializacao = $_POST['especializacao'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;

    $UsuarioSenha->beginTransaction();

    $sql_medico = "INSERT INTO medicos (nome, crm, especializacao) VALUES (:nome, :crm, :especializacao)";
    $stmt_medico = $UsuarioSenha->prepare($sql_medico);
    $stmt_medico->bindParam(':nome', $nome);
    $stmt_medico->bindParam(':crm', $crm);
    $stmt_medico->bindParam(':especializacao', $especializacao);

    if ($stmt_medico->execute()) {
        $id_medico = $UsuarioSenha->lastInsertId();

        // Inserir os horários do médico
        $sql_horario = "INSERT INTO horarios_medicos (id_medico, dia_semana, hora_inicio, hora_fim, disponivel, especializacao) 
                        VALUES (:id_medico, :dia_semana, :hora_inicio, :hora_fim, :disponivel, :especializacao)";
        $stmt_horario = $UsuarioSenha->prepare($sql_horario);
        $stmt_horario->bindParam(':id_medico', $id_medico);
        $stmt_horario->bindParam(':dia_semana', $dia_semana);
        $stmt_horario->bindParam(':hora_inicio', $hora_inicio);
        $stmt_horario->bindParam(':hora_fim', $hora_fim);
        $stmt_horario->bindParam(':disponivel', $disponivel);
        $stmt_horario->bindParam(':especializacao', $especializacao);

        if ($stmt_horario->execute()) {
            $UsuarioSenha->commit();
            echo "<script>alert('Médico e horário cadastrados com sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "../perfil.php"; },);</script>';  
        } else {
            $UsuarioSenha->rollBack();
            echo "Erro ao cadastrar horário: " . $stmt_horario->errorInfo()[2];
        }
    } else {
        $UsuarioSenha->rollBack();
        echo "Erro ao cadastrar médico: " . $stmt_medico->errorInfo()[2];
    }
} catch (PDOException $e) {
    $UsuarioSenha->rollBack();
    echo "Erro de conexão: " . $e->getMessage();
}
?>
