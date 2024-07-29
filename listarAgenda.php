<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

include './classe/Usuarios.php';

$usuario = new Usuarios();

if ($id_cliente && is_numeric($id_cliente)) {
    $dados = $usuario->listarAgendamentos($id_cliente);
    $agendamentos = $dados['agendamentos'];
    $email = $dados['email'];
    $servicos = $dados['servicos'];
} else {
    $agendamentos = [];
    $email = null;
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
    .container {
        top: 110px;
        margin-bottom: 20%;
    }
</style>
<body>
    <div class="container">
        <main class="form-table w-100 m-auto">
            <a href="<?= $id_cliente ? 'perfil.php?id_cliente=' . $id_cliente : 'javascript:history.back()'; ?>" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem; color:white;"></i>
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
                            <th scope="col"></th></th>
                            <th scope="col">Horário</th>
                            <th scope="col"></th><th></th>
                            <th scope="col">Data</th>
                            <th scope="col"></th></th>
                            <th></th>
                            <th scope="col" class="d-flex justify-content-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($agendamentos)) {
                            foreach ($agendamentos as $value) {
                                // Obtenha o nome do serviço correspondente
                                $servicoNome = '';
                                foreach ($servicos as $servico) {
                                    if ($servico['id_servico'] == $value['servico']) {
                                        $servicoNome = $servico['name'];
                                        break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($email) ?></td>
                                    <th></th>
                                    <td><?= htmlspecialchars($value['hora_agendamento']) ?></td>
                                    <th></th><th></th>
                                    <td><?= htmlspecialchars($value['data_agendamento']) ?></td>
                                    <th></th><th></th>           
                                    <td class="d-flex justify-content-center gap-2">
                                        <form action="listarAgenda.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="id_agendamento" value="<?= htmlspecialchars($value['id_agendamento']) ?>">
                                            <button type="submit" name="delete" class="button red">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum agendamento encontrado.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
