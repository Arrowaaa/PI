<?php
session_start();
include './auxi/config.php';
include './classe/Usuarios.php';


$usuario = new Usuarios();
$consultas = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['especializacao'])) {
    $id_especializacao = filter_var($_POST['especializacao'], FILTER_SANITIZE_NUMBER_INT);
    $consultas = $usuario->listarConsultasPorEspecializacao($id_especializacao);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Consultas por Especialização</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<style>
    .container body {
        display: flex;
        justify-content: center;
        background-color: #9c6131 !important;
    }

    .content {
        margin-top: 2%;
        color: whitesmoke;
        border-radius: 8px;
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

    th {
        padding: 12px 0;
        text-align: center;
        border-bottom: 5px solid #000000;
    }

    td {
        padding: 12px 0;
        text-align: center;
        border-bottom: 5px solid #000000;
        font-size: 18px;
    }

    th {
        background-color: #f4f4f4;
        color: #000000;
        font-size: 18px;
    }

    .button.red {
        font-size: 15px;
        background-color: red;
        color: white;
        margin-bottom: 20px;
        padding: 13px 20px;
    }

    .button.red:hover {
        background-color: black;
        color: red;
    }
</style>

<body>
    <div class="container">
        <main class="content">
            <h1 style="color: white; text-align: center;">Consultas por Especialização</h1><br><br>
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <form method="POST" action="">
                <label for="especializacao">Escolha a Especialização:</label>
                <select id="especializacao" name="especializacao" required>
                    <option value="">Selecione uma especialização</option>
                    <?php
                    global $UsuarioSenha;
                    $sql = "SELECT id_especializacao, especializacao FROM especializacao";
                    $stmt = $UsuarioSenha->query($sql);
                    $especializacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($especializacoes as $especializacao) {
                        echo "<option value='" . htmlspecialchars($especializacao["id_especializacao"]) . "'>" . htmlspecialchars($especializacao["especializacao"]) . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Ver Consultas">
            </form>
            <br>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID Agendamento</th>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($consultas)) {
                            foreach ($consultas as $consulta) {
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($consulta['id_agendamento']) ?></td>
                                    <td><?= htmlspecialchars($consulta['data_agendamento']) ?></td>
                                    <td><?= htmlspecialchars($consulta['hora_agendamento']) ?></td>
                                    <td><?= htmlspecialchars($consulta['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($consulta['nome_servico']) ?></td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='5'>Nenhuma consulta encontrada para esta especialização.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
