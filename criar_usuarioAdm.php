<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    .container {
        position: relative;
        padding: 50px;
        border-radius: 40px;
        width: 26vw;
        margin: 30px auto;
        text-align: center;
        color: white;
    }

    h1 {
        color: #fff;
    }

    .button-link {
        font-family: "Croissant One", "serif";
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        background-color: #FF9239;
        font-size: 16px;
        border: none;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 10px;
        letter-spacing: 4px
    }

    .button-link span {
        position: absolute;
        display: block;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    .button-link:hover {
        background: #FF9239;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #FF9239,
            0 0 25px #FF9239,
            0 0 50px #FF9239,
            0 0 100px #FF9239;
    }

    .button-link span:nth-child(1) {
        bottom: 2px;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #fff);
        animation: btn-anim1 2s linear infinite;
    }
</style>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirma'])) {
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirmSenha'];

        $usuario = new Usuarios();
        $resultado = $usuario->CadastroUsuario($email, $password, $passwordConfirm);

        if ($resultado === "Usuário cadastrado com sucesso") {
            header('Location: /login.php');
            exit();
        } elseif ($resultado === "<br>Usuário já existe") {
            header('Location: criar-usuario.php?erro=usuario_existe');
            exit();
        } elseif ($resultado === "<br>Senhas não são iguais") {
            header('Location: criar-usuario.php?erro=senhas_nao_iguais');
            exit();
        } else {
            echo $resultado;
        }
    }
}
?>

<body>

    <div class="imagens">
        <img src="assets/img/cachorros/cachorro.png" id="imagem-direita" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <a href="login.php" id="botaoVoltar">
            <i class="bi bi-arrow-left-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <main class="form-signin w-100 m-auto">
            <form action="./auxi/auxcadastro.php" method="POST">
                <h1> Crie Seu Usuário ADM</h1><br>

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>

                <div class="input-group password-group">
                    <label for="confirmSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" required>
                    <button type="button" id="mostrarConfirmSenha"></button>
                </div><br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Criar <span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </main>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>