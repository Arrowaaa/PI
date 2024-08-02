<?php
session_start();
include './classe/Usuarios.php';
include './classe/pessoas.php';
$usuario = new Usuarios();

// Verifique se o formulário foi enviado para deletar um agendamento
if (isset($_POST['delete']) && isset($_POST['id_agendamento'])) {
    $id_agendamento = $_POST['id_agendamento'];
    $resultado = $usuario->deletarAgendamento($id_agendamento);
    if ($resultado > 0) {
        echo '<p class="alert alert-success">Agendamento Deletado Com Sucesso!!!</p>';
        echo '<script>setTimeout(function() { window.location.href = "listarAgenda.php"; }, 1800);</script>';
        exit();
    } else {
        echo "<p class='alert alert-danger'>Erro ao deletar agendamento ou agendamento não encontrado.</p>";
    }
}

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;

if ($id_cliente && is_numeric($id_cliente)) {
    $dados = $usuario->listarAgendamentos($id_cliente);
    $agendamentos = isset($dados['agendamentos']) ? $dados['agendamentos'] : [];
    $email = isset($dados['email']) ? $dados['email'] : '';
    $servicos = isset($dados['servicos']) ? $dados['servicos'] : [];
} else {
    $agendamentos = [];
    $email = '';
    $servicos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Agendamentos</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        background-color: #9c6131 !important;
    }

    .content {
        margin-top: 2%;
        background-color: #FF9239;
        color: black;
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
        <main class="form-table w-100 m-auto">
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
                echo "<p class='alert alert-success'>Agendamento Deletado com Sucesso!!</p>";
            } ?>
            <h1 style="color: white; text-align: center;">Lista de Agendamentos</h1><br>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Serviço</th>
                            <th scope="col">Data</th>
                            <th scope="col" class="">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($agendamentos)) {
                            foreach ($agendamentos as $value) {
                                $servicoNome = pessoas::servico($value['servico']);
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($email) ?></td>
                                    <td><?= htmlspecialchars($value['hora_agendamento']) ?></td>
                                    <td><?= htmlspecialchars($servicoNome) ?></td>
                                    <td><?= htmlspecialchars($value['data_agendamento']) ?></td>
                                    <td class="d-flex justify-content-end gap-2">
                                        <form action="listarAgenda.php" method="POST">
                                            <input type="hidden" name="id_agendamento" value="<?= htmlspecialchars($value['id_agendamento']) ?>">
                                            <button type="submit" name="delete" class="button red">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='4'>Nenhum agendamento encontrado.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>