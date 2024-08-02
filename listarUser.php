<?php
session_start();

// Inclui a classe Usuarios
require_once './classe/Usuarios.php';

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;

$usuario = new Usuarios();
$dados = $usuario->listarUsuarios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id_cliente = $_POST['id_cliente'];
        $resultado = $usuario->deletarUsuario($id_cliente);
        if ($resultado == 1) {
            echo '<p class="alert alert-success">Usuário Deletado Com Sucesso!!!</p>';
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "listarUser.php?deletado=1"; }, 1600);';
            echo '</script>';
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
            background-color: rgba(0, 0, 0, 0.7) ;
            color: whitesmoke;
            border-radius: 5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 1200px ;
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
    </style>
</head>

<body>
    <div class="container">
        <main class="form-table w-10 m-auto">
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {
                echo "<p class='alert alert-success'>Usuário Deletado com Sucesso!!</p>";
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
                                    <form action="listarUser.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($value['id_cliente']) ?>">
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
