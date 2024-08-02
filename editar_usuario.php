<?php  //teste se utilize essa pagina ou não.
session_start();

require_once './classe/Usuarios.php';

$usuario = new Usuarios();
$dadosUsuario = [];
$email = isset($_GET['email']) ? $_GET['email'] : null;

// Verificar se o e-mail do cliente foi passado e obter os dados
if ($email) {
    $_SESSION['email'] = $email; // Defina a sessão email aqui
    $dadosUsuario = $usuario->obterUsuarioPorEmail($email);

    // Se não há dados, redirecionar ou exibir erro
    if (!$dadosUsuario) {
        echo '<p class="alert alert-danger">Cliente não encontrado.</p>';
        exit();
    }
}

// Determinar a URL de redirecionamento do botão Voltar
$voltarUrl = !empty($email) ? 'perfil.php?email=' . $email : 'listarUser.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    if ($email) {
        $cpf = $_POST['cpf'];
        $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : null;
        // Atualizar informações do cliente
        $resultado = $usuario->EditarUsuarios($email, $cpf, $nivel); // Adapte a chamada conforme sua função
        if ($resultado) {
            echo '<p class="alert alert-success">Cliente atualizado com sucesso!!!</p>';
        } else {
            echo '<p class="alert alert-danger">Erro ao atualizar Cliente.</p>';
        }
    } else {
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
            <form action="editar_usuario.php" method="POST">
                <h1>Alterar Dados do Usuário</h1><br>

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" readonly required>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>" required>
                    <script src="assets/js/mascaras.js"></script>
                </div>

                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" disabled required>
                    <button type="button" id="mostrarSenha" onclick="toggleSenha()">Alterar</button>
                </div>

                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" value="" disabled required>
                    <button type="button" id="mostrarConfirmSenha" onclick="toggleConfirmSenha()">Alterar</button>
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
                        <button type="submit" class="button-link">Salvar Alterações<span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </main>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>
