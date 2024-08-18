<?php
session_start();

require_once './classe/Usuarios.php';

$usuario = new Usuarios($UsuarioSenha);
$dados = $usuario->listarUsuarios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id_cliente = $_POST['id_cliente'];
        $resultado = $usuario->desativarUsuario($id_cliente);
        if ($resultado == 1) {
            echo "<script>alert('Cliente Desativado Com Sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarUser.php"; },);</script>';
            exit();
        } else {
            $erro = "Erro ao desativar Cliente.";
        }
    }
    if (isset($_POST['update'])) {
        $id_cliente = $_POST['id_cliente'];
        $nivel = $_POST['nivel'];
        $resultado = $usuario->EditarUsuarios($id_cliente, $nivel);
        if ($resultado == 1) {
            echo "<script>alert('Cliente atualizado com sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarUser.php"; },);</script>';
            exit();
        } else {
            echo "<script>alert('Erro ao atualizar Cliente!');</script>";
            $erro = "Erro ao atualizar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
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
        th, td {
            padding: 12px 5px;
            text-align: center;
            border-bottom: 5px solid #000000;
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
        .edit-form {
            display: none; /* Oculta a div inicialmente */
        }
    </style>
</head>
<body>
    <div class="container">
        <main class="form-table w-10 m-auto">
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
                echo "<p class='alert alert-success'>Usuário Desativado com Sucesso!!</p>";
            } elseif (isset($erro)) {
                echo "<p class='alert alert-danger'>$erro</p>";
            } ?>
            <h1 class="h3 mb-3 fw-normal text-align: center;">Lista de Usuários</h1>
            <div style="display: flex; justify-content: center; text-align: center;">
                <table class="table table-striped table-light table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID Cliente</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Nivel</th>
                            <th scope="col" class="d-flex justify-content-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $value) { ?>
                            <tr>
                                <th scope="row"><?= htmlspecialchars($value['id_cliente']) ?></th>
                                <td><?= htmlspecialchars($value['nome']) ?></td>
                                <td><?= htmlspecialchars($value['cpf']) ?></td>
                                <td><?= htmlspecialchars($value['email']) ?></td>
                                <td><?= htmlspecialchars($value['estado']) ?></td>
                                <td><?= htmlspecialchars($value['nivel']) ?></td>
                                <td class="d-flex justify-content-center gap-2">
                                    <button type="button" class="button yellow" onclick="showEditForm(<?= htmlspecialchars($value['id_cliente']) ?>)">Editar</button>
                                    <form action="listarUser.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($value['id_cliente']) ?>">
                                        <button type="submit" name="delete" class="button red">Desativar</button>
                                    </form>
                                </td>
                            </tr>
                            <tr id="edit-<?= htmlspecialchars($value['id_cliente']) ?>" class="edit-form">
                                <td colspan="7">
                                    <form action="listarUser.php" method="POST">
                                        <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($value['id_cliente']) ?>">
                                        <div class="input-group nivel">
                                            <label for="nivel">Nível:</label>
                                            <select id="nivel" name="nivel" required>
                                                <option value="base" <?= isset($value['nivel']) && $value['nivel'] == 'base' ? 'selected' : '' ?>>Base</option>
                                                <option value="adm" <?= isset($value['nivel']) && $value['nivel'] == 'adm' ? 'selected' : '' ?>>Adm</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="update" class="button yellow">Atualizar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        function showEditForm(id_cliente) {
            // Oculta todas as divs de edição
            const editForms = document.querySelectorAll('.edit-form');
            editForms.forEach(form => form.style.display = 'none');

            // Mostra a div de edição específica
            const editForm = document.getElementById('edit-' + id_cliente);
            if (editForm) {
                editForm.style.display = 'table-row';
            }
        }
    </script>
</body>
</html>
