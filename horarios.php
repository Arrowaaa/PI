<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

require_once './auxi/config.php';

try {
    $especializacoes = $UsuarioSenha->query("SELECT id_especializacao, especializacao FROM especializacao")->fetchAll(PDO::FETCH_ASSOC);
    $diasSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medico = $_POST['nome'];
    $crm = $_POST['crm'];
    $especializacao = $_POST['especializacao'];
    $diasemana = $_POST['diasemana'];
    $horarioinicio = $_POST['horarioinicio'];
    $horariofim = $_POST['horariofim'];

    try {
        $UsuarioSenha->beginTransaction();
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
        $UsuarioSenha->commit();
        echo "<script>alert('Horário salvo com sucesso!');</script>";
        echo '<script>setTimeout(function() { window.location.href = "perfil.php"; },);</script>';
    } catch (PDOException $e) {
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
            <h2>Cadastro Médico e seu Horário de Trabalho</h2><br>
            <form id="horariosForm" action="#" method="POST">
                <div class="input-group">
                    <label for="nome">Médico:</label>
                    <input type="text" id="nome" name="nome" minlength="3" maxlength="40" required>
                </div>
                <div class="input-group">
                    <label for="crm">CRM:</label>
                    <input type="text" id="crm" name="crm" minlength="6" maxlength="8" required>
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
                <div>
                    <label for="horarioinicio">Horário de Início::</label>
                    <select id="horarioinicio" name="horarioinicio" required>
                        <option value=""></option>
                        <option value="06:15">06:15</option>
                        <option value="07:00">07:00</option>
                        <option value="07:45">07:45</option>
                        <option value="08:30">08:30</option>
                        <option value="09:15">09:15</option>
                        <option value="10:00">10:00</option>
                        <option value="10:45">10:45</option>
                        <option value="11:30">11:30</option>
                        <option value="12:15">12:15</option>
                    </select>
                </div><br>
                <div class="group">
                    <label for="horariofim">Horário de Fim:</label>  
                    <select id="horariofim" name="horariofim" required>
                        <option value="13:15">13:15</option>
                        <option value="14:00">14:00</option>
                        <option value="14:45">14:45</option>
                        <option value="15:30">15:30</option>
                        <option value="16:15">16:15</option>
                        <option value="17:00">17:00</option>
                        <option value="17:45">17:45</option>
                        <option value="18:30">18:30</option>
                        <option value="19:15">19:15</option>
                        <option value="20:00">20:00</option>
                    </select>
                </div><br>
                <center>
                    <button type="submit" class="button-link">Salvar Horário<span></span></button>
                </center>
            </form>
        </div>
    </div>
    <script src="./assets/js/mascaras.js"></script>
    <script src="./assets/js/mascaras.js"></script>
</body>

</html>