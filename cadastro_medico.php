<?php
session_start();
require_once './classe/Usuarios.php';
include './auxi/config.php';

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'adm') {
    header("Location: login.php"); // Redireciona para a página de login
    exit(); // Termina a execução do script
}

$usuario = new Usuarios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id_medico = $_POST['id_medico'];
        $resultado = $usuario->deletarMedico($id_medico);
        if ($resultado) {
            echo "<script>alert('Médico Deletado Com Sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarMedicos.php"; },);</script>';
            exit();
        } else {
            $erro = "Erro ao deletar médico.";
        }
    }
    if (isset($_POST['update'])) {
        $id_medico = $_POST['id_medico'];
        $nome = $_POST['nome'];
        $crm = $_POST['crm'];
        $especializacao = $_POST['especializacao'];
        $resultado = $usuario->atualizarMedico($id_medico, $nome, $crm, $especializacao);
        if ($resultado) {
            echo "<script>alert('Médico Atualizado Com Sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarMedicos.php"; },);</script>';
            exit();
        } else {
            $erro = "Erro ao atualizar médico.";
        }
    }
    if (isset($_POST['add_horario'])) {
        $id_medico = $_POST['id_medico'];
        $dia_semana = $_POST['dia_semana'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim = $_POST['hora_fim'];
        $disponivel = isset($_POST['disponivel']) ? 1 : 0;
        $resultado = $usuario->adicionarHorarioMedico($id_medico, $dia_semana, $hora_inicio, $hora_fim, $disponivel);
        if ($resultado) {
            echo "<script>alert('Horario do Médico Atualizado Com Sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarMedicos.php"; },);</script>'; 
            exit();
        } else {
            $erro = "Erro ao adicionar horário.";
        }
    }
}

$medicos = $usuario->listarMedicos();
$especializacoes = $usuario->listarEspecializacoes();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Médicos</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            background-color: #9c6131 !important;
        }
        .container {
            margin-top: 2%;
            background-color: rgba(0, 0, 0, 0.7);
            color: whitesmoke;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 1200px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th,
        td {
            padding: 12px 5px;
            text-align: center;
            border-bottom: 1px solid #000000;
        }
        th {
            background-color: #f4f4f4;
            color: #000000;
            padding: 20px;
        }
        .button {
            border: none;
            padding: 12px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .button.yellow {
            background-color: yellowgreen;
            color: black;
        }
        .button.yellow:hover {
            background-color: black;
            color: yellow;
        }
        .button.red {
            background-color: red;
            color: white;
        }
        .button.red:hover {
            background-color: black;
            color: red;
        }
        .hidden {
            display: none;
        }
        .editable {
            display: none;
        }
    </style>
    <script>
        function clickEdit(id_medico) {
            document.querySelector(`#edit-${id_medico}`).classList.toggle('hidden');
            document.querySelector(`#view-${id_medico}`).classList.toggle('hidden');
        }

        function clickAddHorario(id_medico) {
            document.querySelector(`#add-horario-${id_medico}`).classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <div class="container">
        <main class="form-table w-10 m-auto">
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
                echo "<p class='alert alert-success'>Médico Deletado com Sucesso!!</p>";
            } elseif (isset($_GET['atualizado']) && $_GET['atualizado'] == 1) {
                echo "<p class='alert alert-success'>Médico Atualizado com Sucesso!!</p>";
            } elseif (isset($_GET['horario_adicionado']) && $_GET['horario_adicionado'] == 1) {
                echo "<p class='alert alert-success'>Horário Adicionado com Sucesso!!</p>";
            } elseif (isset($erro)) {
                echo "<p class='alert alert-danger'>$erro</p>";
            } ?>
            <h1 class="h3 mb-3 fw-normal text-align: center;">Lista de Médicos</h1>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID Médico</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CRM</th>
                            <th scope="col">Especialização</th>
                            <th scope="col">Horários</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicos as $medico) {
                            $horarios = $usuario->listarHorariosMedicos($medico['id_medico']);
                        ?>
                            <tr>
                                <th scope="row"><?= htmlspecialchars($medico['id_medico']) ?></th>
                                <td id="view-<?= htmlspecialchars($medico['id_medico']) ?>">Dr. <?= htmlspecialchars($medico['nome']) ?></td>
                                <td id="view-crm-<?= htmlspecialchars($medico['id_medico']) ?>"><?= htmlspecialchars($medico['crm']) ?></td>
                                <td id="view-especializacao-<?= htmlspecialchars($medico['id_medico']) ?>"><?= htmlspecialchars($medico['especializacao']) ?></td>
                                <td>
                                    <?php foreach ($horarios as $horario) { ?>
                                        <div>
                                            <?= htmlspecialchars($horario['dia_semana']) ?>: <?= htmlspecialchars($horario['hora_inicio']) ?> - <?= htmlspecialchars($horario['hora_fim']) ?>
                                            (<?= $horario['disponivel'] ? 'Disponível' : 'Indisponível' ?>)
                                        </div>
                                    <?php } ?>
                                    <button class="button yellow" onclick="clickAddHorario(<?= htmlspecialchars($medico['id_medico']) ?>)">Adicionar Horário</button>
                                    <form action="listarMedicos.php" method="POST" class="hidden" id="add-horario-<?= htmlspecialchars($medico['id_medico']) ?>">
                                        <input type="hidden" name="id_medico" value="<?= htmlspecialchars($medico['id_medico']) ?>">
                                        <select name="dia_semana" required>
                                            <option value="Segunda">Segunda</option>
                                            <option value="Terça">Terça</option>
                                            <option value="Quarta">Quarta</option>
                                            <option value="Quinta">Quinta</option>
                                            <option value="Sexta">Sexta</option>
                                            <option value="Sábado">Sábado</option>
                                            <option value="Domingo">Domingo</option>
                                        </select>
                                        <input type="time" name="hora_inicio" required>
                                        <input type="time" name="hora_fim" required>
                                        <input type="checkbox" name="disponivel" checked> Disponível
                                        <button type="submit" name="add_horario" class="button yellow">Salvar Horário</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="button yellow" onclick="clickEdit(<?= htmlspecialchars($medico['id_medico']) ?>)">Editar</button>
                                    <form action="listarMedicos.php" method="POST" class="hidden" id="edit-<?= htmlspecialchars($medico['id_medico']) ?>">
                                        <input type="hidden" name="id_medico" value="<?= htmlspecialchars($medico['id_medico']) ?>">
                                        <input type="text" name="nome" value=" <?= htmlspecialchars($medico['nome']) ?>" minlength="3" maxlength="30" required>
                                        <input type="text" name="crm" value="<?= htmlspecialchars($medico['crm']) ?>" minlength="6" maxlength="8" required>
                                        <select name="especializacao" required>
                                            <?php foreach ($especializacoes as $especializacao) { ?>
                                                <option value="<?= htmlspecialchars($especializacao['id_especializacao']) ?>" <?= $medico['especializacao'] == $especializacao['id_especializacao'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($especializacao['especializacao']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <button type="submit" name="update" class="button yellow">Salvar Alterações</button>
                                    </form>
                                    <form action="listarMedicos.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_medico" value="<?= htmlspecialchars($medico['id_medico']) ?>">
                                        <button type="submit" name="delete" class="button red">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
