<?php
$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

require_once './classe/Usuarios.php';
$usuario = new Usuarios();
$dadosUsuario = [];

if (!empty($id_usuario)) {
    $dadosUsuario = $usuario->obterUsuarioPorId($id_usuario);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($id_usuario) ? 'Editar Usuário' : 'Criar Usuário' ?></title>
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
        <a href="<?= $id_cliente ? 'perfil.php?id_cliente=' . $id_cliente : 'javascript:history.back()'; ?>" id="botaoVoltar">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <main class="form-signin w-100 m-auto">
            <form action="criar_usuario.php" method="POST">
                <input type="hidden" name="id_para_alterar" value="<?= isset($dadosUsuario['id_usuario']) ? htmlspecialchars($dadosUsuario['id_usuario']) : '' ?>">
                <h1><?= isset($id_usuario) ? 'Alterar Dados do Usuário ADM' : 'Crie Seu Usuário ADM' ?></h1><br>

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" readonly required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" <?= isset($id_usuario) ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarSenha"></button>
                </div>

                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" <?= isset($id_usuario) ? 'disabled' : '' ?> required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div>

                <div class="input-group nivel">
                    <label for="nivel">Nível:</label>
                    <input type="text" id="nivel" name="nivel" value="<?= isset($dadosUsuario['nivel']) ? htmlspecialchars($dadosUsuario['nivel']) : '' ?>" required>
                </div><br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link"><?= isset($id_usuario) ? 'Salvar Alterações' : 'Criar' ?> <span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </main>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirmSenha'])) {
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirmSenha'];
        $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : null; // Nível é opcional

        if (isset($_POST['id_para_alterar']) && !empty($_POST['id_para_alterar'])) {
            // Atualizar usuário existente
            $id_para_alterar = $_POST['id_para_alterar'];
            $resultado = $usuario->EditarUsuarios($id_para_alterar, $email, $nivel);

            if ($resultado) {
                header('Location: perfil.php?id_usuario=' . $id_para_alterar);
                exit();
            } else {
                $erro = "Erro ao atualizar usuário.";
            }
        } else {
            // Criar um novo usuário
            if ($password === $passwordConfirm) {
                $resultado = $usuario->CadastroADM($email, $password, $passwordConfirm, $nivel);

                if ($resultado === "ADM cadastrado com sucesso") {
                    header('Location: /login.php');
                    exit();
                } elseif ($resultado === "<br>ADM já existe") {
                    header('Location: criar_usuario.php?erro=usuario_existe');
                    exit();
                } elseif ($resultado === "<br>Senhas não são iguais") {
                    header('Location: criar_usuario.php?erro=senhas_nao_iguais');
                    exit();
                } else {
                    echo $resultado;
                }
            } else {
                echo "As senhas não coincidem.";
            }
        }
    }
}
?>
