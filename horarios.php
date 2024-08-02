<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

require_once './auxi/config.php';

try {
    // Buscar especializações
    $especializacoes = $UsuarioSenha->query("SELECT id_especializacao, especializacao FROM especializacao")->fetchAll(PDO::FETCH_ASSOC);

    // Buscar dias da semana
    $diasSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medico = $_POST['medico'];
    $crm = $_POST['crm'];
    $especializacao = $_POST['especializacao'];
    $diasemana = $_POST['diasemana'];
    $horarioinicio = $_POST['horarioinicio'];
    $horariofim = $_POST['horariofim'];

    try {
        // Iniciar transação
        $UsuarioSenha->beginTransaction();

        // Inserir dados do médico
        $stmtMedico = $UsuarioSenha->prepare("INSERT INTO medicos (nome, crm, especializacao) VALUES (:medico, :crm, :especializacao)");
        $stmtMedico->bindParam(':medico', $medico);
        $stmtMedico->bindParam(':crm', $crm);
        $stmtMedico->bindParam(':especializacao', $especializacao);
        $stmtMedico->execute();

        // Obter o id_medico gerado
        $id_medico = $UsuarioSenha->lastInsertId();

        // Inserir dados do horário do médico
        $stmtHorario = $UsuarioSenha->prepare("INSERT INTO horarios_medicos (id_medico, dia_semana, hora_inicio, hora_fim, especializacao) VALUES (:id_medico, :diasemana, :horarioinicio, :horariofim, :especializacao)");
        $stmtHorario->bindParam(':id_medico', $id_medico);
        $stmtHorario->bindParam(':diasemana', $diasemana);
        $stmtHorario->bindParam(':horarioinicio', $horarioinicio);
        $stmtHorario->bindParam(':horariofim', $horariofim);
        $stmtHorario->bindParam(':especializacao', $especializacao);
        $stmtHorario->execute();

        // Commit transação
        $UsuarioSenha->commit();
        echo "Horário salvo com sucesso!";
    } catch (PDOException $e) {
        // Rollback em caso de erro
        $UsuarioSenha->rollBack();
        die("Erro ao salvar horário: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários de Trabalho</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container">
        <a href="perfil.php" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <div class="login-box">
            <h2>Horários de Trabalho</h2>
            <form id="horariosForm" action="#" method="POST">
                <div class="input-group">
                    <label for="medico">Médico:</label>
                    <input type="text" id="medico" name="medico" required>
                </div>
                <div class="input-group">
                    <label for="crm">CRM:</label>
                    <input type="text" id="crm" name="crm" required>
                </div><br>
                <div class="input-group">
                    <label for="especializacao">Especialização:</label>  
                    <select id="especializacao" name="especializacao" required>
                        <option></option>
                        <?php foreach ($especializacoes as $especializacao) : ?>
                            <option value="<?= $especializacao['id_especializacao'] ?>"><?= $especializacao['especializacao'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br>
                <div class="input-group">
                    <label for="diasemana">Dia da Semana:</label>  
                    <select id="diasemana" name="diasemana" required>
                        <option></option>
                        <?php foreach ($diasSemana as $dia) : ?>
                            <option value="<?= $dia ?>"><?= $dia ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br>
                <div class="group">
                    <label for="horarioinicio">Horário de Início:</label>  
                    <input type="time" id="horarioinicio" name="horarioinicio" required>
                </div><br>
                <div class="group">
                    <label for="horariofim">Horário de Fim:</label>  
                    <input type="time" id="horariofim" name="horariofim" required>
                </div><br>
                <center>
                    <button type="submit" class="button-link">Salvar Horário<span></span></button>
                </center>
            </form>
        </div>
    </div>
    <script src="assets/js/mascaras.js"></script>
</body>

</html>