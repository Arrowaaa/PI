<?php
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

include './classe/Usuarios.php';

$usuario = new Usuarios();
$dados = $usuario->listarUsuarios();

// Verifica se uma ação foi solicitada (editar ou deletar)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id_usuario = $_POST['id_usuario'];
        $resultado = $usuario->deletarUsuario($id_cliente);
        if ($resultado == 1) {
            header('Location: listarUser.php?deletado=1');
            exit();
        } else {
            $erro = "Erro ao deletar usuário.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuariosr</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<style>
    .red {
        background-color: red;
    }
    .yellow {
        background-color: yellowgreen;
    }
    .red:hover {
        background-color: black;
        color: red;
    }
    .yellow:hover {
        background-color: black;
        color: yellow;
    }

    body{
        display: flex;
        justify-content: center;
        background-color: #9c6131 !important;
    }
    .content{
        margin-top: -5%;
        background-color: #FF9239;
        color: black;
    }
</style>

<body class="d-flex align-items-center py-4 bg-body-tertiary lista" style="display: flex; margin-top: 12%;">

    <div class="content">
        <main class="form-table w-100 m-auto">
            <a href="<?= $id_cliente ? 'perfil.php?id_cliente=' . $id_cliente : 'javascript:history.back()'; ?>" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem; color:black;"></i>
            </a>
            <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
                echo "<p class='alert alert-success'>Usuário Deletado com Sucesso!!</p>";
            } elseif (isset($erro)) {
                echo "<p class='alert alert-danger'>$erro</p>";
            } ?>
            <h1 style="color: black; text-align: center;" class="h3 mb-3 fw-normal">Lista de Usuários</h1><br>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">ID Usuário</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
                            <th></th>
                            <th scope="col">Nivel</th>
                            <th scope="col" class="d-flex justify-content-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $value) { ?>
                            <tr>
                                <th scope="row"><?= htmlspecialchars($value['id_usuario']) ?></th>
                                <td><?= htmlspecialchars($value['email']) ?></td>
                                <td><?= htmlspecialchars($value['senha']) ?></td><th></th>
                                <td><?= htmlspecialchars($value['nivel']) ?></td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="criar_usuario.php?id_usuario=<?= htmlspecialchars($value['id_usuario']) ?>" class="button yellow">Editar</a>
                                    <form action="listarUser.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($value['id_usuario']) ?>">
                                        <button type="submit" name="delete" class="button red">Apagar</button>
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