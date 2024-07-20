<?php


include './classe/Usuarios.php';

$usuario = new Usuarios();
$dados = $usuario->listarUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/perfil.css">

</head>
<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(rgba(44, 40, 40, 0.5), rgba(48, 42, 42, 0.5)), url(../img/cachorros/5.png);
        z-index: -1;
    }
</style>
<div class="overlay">
    <img src="./assets/img/rodapé cachorro.png" alt="banner" style="width: 100%; height: 50vh; " >
</div>

<body class="d-flex align-items-center py-4 bg-body-tertiary lista" style="display: flex;
margin-top: 12%;">
    <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
        echo "<p class='alert alert-success'>Usuário Deletado com Sucesso!!</p>";
    } ?>
    <div class="content">
        <main class="form-table w-100 m-auto">
            <h1 style="color: black; text-align: center; " class="h3 mb-3 fw-normal">Lista de Usuários</h1>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">ID Usuário</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
                            <th scope="col" class="d-flex justify-content-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $value) { ?>
                            <tr>
                                <th scope="row"><?= htmlspecialchars($value['id_usuario']) ?></th>
                                <td><?= htmlspecialchars($value['email']) ?></td>
                                <td><?= htmlspecialchars($value['senha']) ?></td>
                                <td class="d-flex justify-content-center gap-1">
                                    <a href="cadastro.php?id_usuario=<?= htmlspecialchars($value['id_usuario']) ?>" class="btn btn-warning">Editar</a>
                                    <a href="deletarUser.php<?= htmlspecialchars($value['id_usuario']) ?>" class="btn btn-danger">Apagar</a>
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
