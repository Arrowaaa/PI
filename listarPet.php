<?php
session_start();
require_once './auxi/config.php';
require_once './classe/Usuarios.php';
require_once './classe/pessoas.php';

if (!isset($_SESSION['id_cliente'])) {
    header('Location: login.php');
    exit;
}
$id_cliente = $_SESSION['id_cliente'];
$usuario = new Usuarios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id_pet = $_POST['id_pet'];
        $resultado = $usuario->deletarPet($id_pet);
        if ($resultado) {
            echo "<script>alert('Pet deletado com sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "listarPet.php"; },);</script>';
            exit();
        } else {
            echo "<script>alert('Erro ao deletar pet.');</script>";
            $erro = "Erro ao deletar pet.";
        }
    }
    if (isset($_POST['update'])) {
        $id_pet = $_POST['id_pet'];
        $nomep = $_POST['nomep'];
        $data_nascimento = $_POST['data_nascimento'];
        $raca = $_POST['raca'];
        $peso = $_POST['peso'];
        $porte = $_POST['porte'];
        $sexop = $_POST['sexop'];

        // Verifica se todos os campos necessários estão definidos
        if (isset($id_pet, $nomep, $data_nascimento, $raca, $peso, $porte, $sexop)) {
            $resultado = $usuario->alterePet($id_pet, $nomep, $data_nascimento, $raca, $peso, $sexop, $porte);
            if ($resultado) {
                echo "<script>alert('Pet atualizado com sucesso!!');</script>";
                echo '<script>setTimeout(function() { window.location.href = "listarPet.php"; },);</script>';
                exit();
            } else {
                echo "<script>alert('Erro ao atualizar pet!!');</script>";
                $erro = "Erro ao atualizar pet.";
            }
        } else {
            echo "<script>alert('Todos os campos são obrigatórios.');</script>";
            $erro = "Todos os campos são obrigatórios.";
        }
    }
}

$pets = $usuario->listarPet($id_cliente);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            margin: 20px 0;
            border: 1px solid #0c0b0b;
        }

        td,
        th {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #000000;
            font-size: 18px;
        }

        th {
            background-color: #000000;
            color: whitesmoke;
        }

        .button {
            border: none;
            padding: 12px;
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
    </style>
    <script>
        function toggleEdit(id_pet) {
            document.querySelector(`#edit-${id_pet}`).classList.toggle('hidden');
            document.querySelector(`#view-${id_pet}`).classList.toggle('hidden');
        }
    </script>
</head>

<body>
    <div class="container">
        <a href="perfil.php" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <?php if (isset($_GET['deletado']) && $_GET['deletado'] == 1) {    
        } elseif (isset($_GET['atualizado']) && $_GET['atualizado'] == 1) {
        } elseif (isset($erro)) {
            echo "<p class='alert alert-danger'>$erro</p>";
        } ?>
        <h1 class="h3 mb-3 fw-normal">Lista de Pets</h1>
        <div style="display: flex; justify-content: center;">
            <table class="table table-striped table-light table-sm">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Raça</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Porte</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pets as $pet) { ?>
                        <tr>
                            <td id="view-<?= htmlspecialchars($pet['id_pet']) ?>"><?= htmlspecialchars($pet['nomep']) ?></td>
                            <td><?= htmlspecialchars($pet['data_nascimento']) ?></td>
                            <td><?= htmlspecialchars(pessoas::formatarSexop($pet['sexop'])) ?></td>
                            <td><?= htmlspecialchars($pet['raca']) ?></td>
                            <td><?= htmlspecialchars($pet['peso']) ?></td>
                            <td><?= htmlspecialchars($pet['porte']) ?></td>
                            <td>
                                <button class="button yellow" onclick="toggleEdit(<?= htmlspecialchars($pet['id_pet']) ?>)">Editar</button>
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="id_pet" value="<?= htmlspecialchars($pet['id_pet']) ?>">
                                    <button type="submit" name="delete" class="button red">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        <tr id="edit-<?= htmlspecialchars($pet['id_pet']) ?>" class="hidden">
                            <td colspan="7">
                                <form action="listarPet.php" method="POST">
                                    <input type="hidden" name="id_pet" value="<?= htmlspecialchars($pet['id_pet']) ?>">
                                    <div class="mb-3">
                                        <label for="nomep" class="form-label">Nome</label>
                                        <input type="text" id="nomep" name="nomep" value="<?= htmlspecialchars($pet['nomep']) ?>" class="form-control" minlength="3" maxlength="20" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($pet['data_nascimento']) ?>" class="form-control" min="1900-01-01" max="2024-08-03"required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="raca" class="form-label">Raça</label>
                                        <input type="text" id="raca" name="raca" value="<?= htmlspecialchars($pet['raca']) ?>" class="form-control" minlength="3" maxlength="20"  required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="peso" class="form-label">Peso</label>
                                        <input type="text" id="peso" name="peso" value="<?= htmlspecialchars($pet['peso']) ?>" class="form-control" maxlength="3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="porte" class="form-label">Porte</label>
                                        <select name="porte" id="porte">
                                            <option value="pequeno" <?= $pet['porte'] == 'pequeno' ? 'selected' : '' ?>>Pequeno</option>
                                            <option value="medio" <?= $pet['porte'] == 'medio' ? 'selected' : '' ?>>Médio</option>
                                            <option value="grande" <?= $pet['porte'] == 'grande' ? 'selected' : '' ?>>Grande</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sexop" class="form-label">Sexo</label>
                                        <select name="sexop" id="sexop">
                                            <option value="M" <?= $pet['sexop'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                                            <option value="F" <?= $pet['sexop'] == 'F' ? 'selected' : '' ?>>Feminino</option>
                                            <option value="O" <?= $pet['sexop'] == 'O' ? 'selected' : '' ?>>Outro</option>
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
    </div>
</body>

</html>