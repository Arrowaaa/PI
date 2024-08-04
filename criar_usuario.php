<?php  //teste se utilize essa pagina ou não.
session_start();

require_once './classe/Usuarios.php';

$usuario = new Usuarios();
$dadosUsuario = [];
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

if ($id_usuario) {
    $dadosUsuario = $usuario->obterUsuarioPorId($id_usuario);
}

// Determinar a URL de redirecionamento do botão Voltar
$voltarUrl = !empty($id_usuario) ? 'listarUser.php' : 'perfil.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : null;
        $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;

        if (isset($_POST['id_cliente'])) {
            // Atualizar usuário existente
            $resultado = $usuario->EditarUsuarios($id_cliente, $email, $nivel);

            if (!empty($resultado)) {
                echo '<p class="alert alert-success">Cliente atualizado com sucesso!!!</p>';
                echo $resultado;
                // header('Location: perfil.php');
                exit();
            } else {
                echo '<p class="alert alert-danger">Erro ao atualizar usuário.</p>';
            }
        } else {
            // Criar um novo usuário
            if ($password === $passwordConfirm) {
                $resultado = $usuario->CadastroADM($email, $password, $passwordConfirm, $nivel);

                if ($resultado === "ADM cadastrado com sucesso") {
                    header('Location: login.php');
                    exit();
                } elseif ($resultado === "Usuário já existe") {
                    echo '<p class="alert alert-warning">Usuário já existe!!</p>';
                } else {
                    echo '<p class="alert alert-danger">Erro ao tentar cadastrar: ' . $resultado . '</p>';
                }
            } else {
                echo '<p class="alert alert-danger">Senhas não conferem!</p>';
            }
        }
    
    }
    else{
        echo '<p class="alert alert-danger">Erro!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        .nivel-oculto {
            display: none;
        }

        .nivel-visivel {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="<?= $voltarUrl ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <main class="form-signin w-100 m-auto">
            <form action="criar_usuario.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?= isset($dadosUsuario['id_cliente']) ? htmlspecialchars($dadosUsuario['id_cliente']) : '' ?>">
                <h1><?= $id_usuario != "adm" ? 'Alterar Dados do Usuário ADM' : 'Crie Seu Usuário ADM' ?></h1><br>

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" readonly required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" <?= $id_usuario ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarSenha"></button>
                </div>

                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" <?= $id_usuario ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>

                <div class="input-group nivel">
                    <label for="nivel">Nível:</label>
                    <select id="nivel" name="nivel" required>
                        <option value="base" <?= isset($dadosUsuario['nivel']) && $dadosUsuario['nivel'] == 'base' ? 'selected' : '' ?>>Base</option>
                        <option value="adm" <?= isset($dadosUsuario['nivel']) && $dadosUsuario['nivel'] == 'adm' ? 'selected' : '' ?>>Adm</option>
                    </select>
                </div>
                <br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link"><?= $id_usuario ? 'Salvar Alterações' : 'Criar' ?> <span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </main>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>