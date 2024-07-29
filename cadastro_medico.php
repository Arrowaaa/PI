<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

require_once './auxi/config.php';

// Consulta para carregar especializações
$sqlEspecializacao = "SELECT id_especializacao, especializacao FROM especializacao";
$stmtEspecializacao = $UsuarioSenha->prepare($sqlEspecializacao);
$stmtEspecializacao->execute();
$especializacoes = $stmtEspecializacao->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/medico.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/meddog3.png" alt="cachorro medico" id="esquerda">
        <img src="assets/img/cachorros/meddog2.png" alt="cachorro medico 2" id="direita">
    </div>
    <div class="container">
        <a href="<?= $id_cliente ? 'perfil.php?id_cliente=' . $id_cliente : 'javascript:history.back()'; ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a><br>
        <h1>Cadastro de Médicos</h1>
        <form action="auxcadastromedico.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="crm">CRM:</label>
            <input type="text" id="crm" name="crm" required><br>

            <label for="especializacao">Especialização:</label>
            <select id="especializacao" name="especializacao" required>
                <?php
                if (!empty($especializacoes)) {
                    foreach ($especializacoes as $especializacao) {
                        echo "<option value='" . htmlspecialchars($especializacao['id_especializacao']) . "'>" . htmlspecialchars($especializacao['especializacao']) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma especialização encontrada</option>";
                }
                ?>
            </select><br>

            <label for="dia_semana">Dia da Semana:</label>
            <select id="dia_semana" name="dia_semana" required>
                <option value="">Selecione...</option>
                <option value="Segunda">Segunda</option>
                <option value="Terça">Terça</option>
                <option value="Quarta">Quarta</option>
                <option value="Quinta">Quinta</option>
                <option value="Sexta">Sexta</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select><br>

            <label for="hora_inicio">Hora de Início:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required><br>

            <label for="hora_fim">Hora de Fim:</label>
            <input type="time" id="hora_fim" name="hora_fim" required><br>

            <label for="disponivel">Disponível:</label>
            <div class="check">
                <input type="checkbox" id="disponivel" name="disponivel" value="1" checked>
            </div>
            <br>
            <div class="button-group">
                <center>
                    <button type="submit" class="button-link">Cadastrar<span></span></button>
                </center>
            </div>
        </form>
    </div>
</body>

</html>
